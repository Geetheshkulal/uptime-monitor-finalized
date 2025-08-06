<?php

namespace App\Services;

use App\Models\Subscriptions;
use App\Models\CouponUser;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\RunWhatsAppInvoiceBotTest;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Spatie\LaravelIgnition\ArgumentReducers\ModelArgumentReducer;

class CashfreeService
{
    public function createSubscription(array $validated)
{
    // $plan = Subscriptions::where('plan_id', $validated['plan_id'])->firstOrFail();

    // if ($validated['billing_cycle'] === 'yearly') {
    //     $monthlyAmount = (float) $plan->plan_recurring_amount;
    //     $discountPercent = (float) $plan->yearly_discount;


    //     $yearlyAmount = $monthlyAmount * 12;
    //     $discountAmount = ($yearlyAmount * $discountPercent) / 100;
    //     $finalAmount = $yearlyAmount - $discountAmount;

    //     $validated['plan_recurring_amount'] = (float) $finalAmount;
    //     $validated['amount'] = (float) $finalAmount;
    // } else {

    //     $validated['plan_recurring_amount'] = (float) $plan->plan_recurring_amount;
    //     $validated['amount'] = (float) $plan->plan_recurring_amount;
    // }

   
    try {
        $response = Http::withHeaders([
            'x-client-id' => config('services.cashfree.key'),
            'x-client-secret' => config('services.cashfree.secret'),
            'x-api-version' => '2025-01-01',
            'Content-Type' => 'application/json',
        ])->post('https://sandbox.cashfree.com/pg/subscriptions', [
            'subscription_id' => 'sub_' . rand(1, 1000) . '_' . time(),
            'customer_details' => [
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['mobile'],
                'customer_name' => $validated['name'],
            ],
            'plan_details'=>[
                'plan_id' => $validated['plan_id'],
                'plan_name' => $validated['plan_name'],
                'plan_type' => $validated['plan_type'],
                'plan_currency' => $validated['plan_currency'],
                'plan_amount'=>(float) $validated['plan_recurring_amount'],
                'plan_max_amount'=> (float) $validated['amount'],
                'plan_interval_type' => $validated['billing_cycle'] === 'monthly' ? 'MONTH' : 'YEAR',
            ],
            'authorization_details' => [
                'authorization_amount' => (float) $validated['amount'],
                'authorization_amount_refund' => false,
                'payment_methods' => [
                        'enach',
                        'pnach',
                        'upi',
                        'card'
                ]
            ],
            'subscription_meta' => [
                'return_url' => route('cashfree.response'),
                'notification_email' => $validated['email'],
            ],
        ]);

        $json = $response->json();

        // Optional: handle failure
        if (!$response->successful()) {
            throw new \Exception($json['message'] ?? 'Cashfree API error');
        }

        return $json;
        
    } catch (\Exception $e) {
        // Log::error('Cashfree Subscription API Failed', [
        //     'userId' => auth()->id(),
        //     'error' => $e->getMessage()
        // ]);
        throw $e;
    }
}


public function verifySignature(array $postData, string $receivedSignature): bool
{
    $secretKey = config('services.cashfree.secret');
    
    if (empty($secretKey)) {
        throw new \RuntimeException('Cashfree secret key not configured');
    }

    // 1. Remove signature from verification
    unset($postData['signature']);

    // 2. Sort keys alphabetically (case-sensitive)
    ksort($postData, SORT_STRING);

    // 3. Concatenate all values directly without any separator
    $postDataString = '';
    foreach ($postData as $value) {
        // Convert all empty cases to empty string
        if ($value === null || $value === 'N/A' || $value === '') {
            $value = '';
        }
        $postDataString .= (string)$value;
    }

    Log::info('Cashfree Concatenated String', ['string' => $postDataString]);

    // 4. Generate HMAC-SHA256 signature
    $hash = base64_encode(
        hash_hmac('sha256', $postDataString, $secretKey, true)
    );

    Log::info('Cashfree Signature Comparison', [
        'received' => $receivedSignature,
        'generated' => $hash
    ]);

    // 5. Securely compare signatures
    return hash_equals($hash, $receivedSignature);
}


public function getSubscriptionDetails($subscriptionId)
{
    $response = Http::withHeaders([
        'x-client-id' => config('services.cashfree.key'),
        'x-client-secret' => config('services.cashfree.secret'),
        'x-api-version' => '2025-01-01',
        'Content-Type' => 'application/json',
    ])->get("https://sandbox.cashfree.com/pg/subscriptions/{$subscriptionId}");

    if(!$response->successful()){
        throw new \Exception('Failed to fetch subscription details');
    }

    Log::info('cashfree subscription details', ['response' => $response->json()]);
    return $response->json();
}

public function cancelSubscription($subscriptionId)
{
    $user = auth()->user();

    $response = Http::withHeaders([
        'x-client-id' => config('services.cashfree.key'),
        'x-client-secret' => config('services.cashfree.secret'),
        'x-api-version' => '2025-01-01',
        'Content-Type' => 'application/json',
    ])->post("https://sandbox.cashfree.com/pg/subscriptions/{$subscriptionId}/manage",[

        'action' => 'CANCEL',
    ]);

    if(!$response->successful()){
        throw new \Exception('Failed to fetch subscription details');
    }
    
     $subscriptionData = $response->json();

    $updateData = [
        'status'=> $subscriptionData['subscription_status'] ?? 'CANCELLED',
        'cancelled_at' => now()
    ];

    $updatePaymentTableData=[
        'status' => 'expired',
        'payment_status' => $subscriptionData['subscription_status'] ?? 'CANCELLED',
    ];

    $hasActiveSubscription = UserSubscription::where('user_id', $user->id)
        ->where('status', 'ACTIVE')
        ->exists();

    $updateUserTableData =[
        'premium_end_date' => null,
        'status'=> $hasActiveSubscription ? 'paid' : 'free',
    ];
   

    Payment::where('user_id', $user->id)
            ->where('cashfree_subscription_id', $subscriptionId)
            ->update($updatePaymentTableData);
            
    User::where('id', $user->id)->update($updateUserTableData);
    UserSubscription::where('cashfree_subscription_id', $subscriptionId)->update($updateData);

    return $response->json();

  
}


    public function initiatePayment($name, $email, $mobile, $subscriptionId, $billingCycle, $userId)
    {
        $subscription = Subscriptions::findOrFail($subscriptionId);
        $orderId = 'order_' . rand(1111111111, 9999999999);

        // Log::info('Initiating payment', [
        //     'user_id' => $userId,
        //     'subscription_id' => $subscriptionId,
        //     'billing_cycle' => $billingCycle
        // ]);
        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2025-01-01", 
            "x-client-id: " . config('services.cashfree.key'),
            "x-client-secret" => config('services.cashfree.secret'),
        ];

        $plan_id = $subscription->plan_id;

        $orderAmount = $subscription->amount;
        if ($billingCycle === 'yearly') {
            $orderAmount *= 12;
            if ($subscription->yearly_discount) {
                $orderAmount -= ($orderAmount * ($subscription->yearly_discount / 100));
            }
        }

        $couponCode = CouponUser::with(['coupon' => function ($query) {
            $now = now();
            $query->where('is_active', true)
                ->where(function ($q) use ($now) {
                    $q->whereNull('valid_from')->orWhere('valid_from', '<=', $now);
                })
                ->where(function ($q) use ($now) {
                    $q->whereNull('valid_until')->orWhere('valid_until', '>=', $now);
                });
        }])->where('user_id', $userId)->first()?->coupon;

        $couponCodeValue = null;
        $couponCodeText = null;
        $discount_type = null;

        if ($couponCode && ($couponCode->subscription->id === $subscription->id)) {
            $couponCodeValue = $couponCode->value;
            $couponCodeText = $couponCode->code;
            $discount_type = $couponCode->discount_type;

            $orderAmount = ($discount_type === 'flat')
                ? max(0, $orderAmount - $couponCodeValue)
                : round(max(0, $orderAmount - (($couponCodeValue / 100) * $orderAmount)));
        }

        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . config('services.cashfree.key'),
            "x-client-secret: " . config('services.cashfree.secret'),
        ];

        $data = json_encode([
            'order_id' => $orderId,
            'order_amount' => $orderAmount,
            'order_currency' => 'INR',
            'order_note' => "subscription_id:$subscriptionId|user_id:$userId|coupon:$couponCodeText|value:$couponCodeValue|discount_type:$discount_type|billing:$billingCycle",
            'customer_details' => [
                'customer_id' => 'customer_' . rand(111111111, 999999999),
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $mobile,
            ],
            'order_meta' => [
                'return_url' => route('planSubscription') . '?payment_success=1',
                'notify_url' => route('webhook'),
            ],
        ]);

        $url = "https://sandbox.cashfree.com/pg/orders";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $resp = curl_exec($curl);
        curl_close($curl);

        Log::info('Cashfree Init Response', ['response' => $resp]);

        return [
            'payment_link' => json_decode($resp)->payment_link ?? null,
            'order_id' => $orderId
        ];
    }

    public function verifyAndProcessPayment($orderId)
    {
        $existingPayment = Payment::where('transaction_id', $orderId)->first();
        if ($existingPayment) return $existingPayment;

        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id" => config('services.cashfree.key'),
            "x-client-secret" => config('services.cashfree.secret'),
        ];

        $curl = curl_init("https://sandbox.cashfree.com/pg/orders/{$orderId}");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $orderResp = curl_exec($curl);
        curl_close($curl);
        $orderDetails = json_decode($orderResp, true);

        if (($orderDetails['order_status'] ?? '') !== 'PAID') return null;

        $curl = curl_init("https://sandbox.cashfree.com/pg/orders/{$orderId}/payments");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $paymentResp = curl_exec($curl);
        curl_close($curl);
        $paymentDetails = json_decode($paymentResp, true);

        $paymentMethod = $paymentDetails[0]['payment_method'] ?? 'unknown';
        if (is_array($paymentMethod)) {
            $methodTypes = array_keys($paymentMethod);
            $paymentMethod = $methodTypes[0] ?? 'unknown';
        }

        $noteParts = explode('|', $orderDetails['order_note'] ?? '');
        $map = collect($noteParts)->mapWithKeys(function ($item) {
            [$key, $val] = explode(':', $item . ':');
            return [$key => $val];
        });

        $subscriptionId = $map['subscription_id'] ?? null;
        $userId = $map['user_id'] ?? null;
        $couponCode = $map['coupon'] ?? null;
        $couponValue = (float)($map['value'] ?? 0);
        $discountType = $map['discount_type'] ?? null;
        $billingCycle = $map['billing'] ?? 'monthly';

        $paymentStatus = $paymentDetails[0]['payment_status'] ?? 'PENDING';
        $paymentAmount = $paymentDetails[0]['payment_amount'] ?? $orderDetails['order_amount'];

        return DB::transaction(function () use ($orderId, $userId, $subscriptionId, $paymentMethod, $paymentAmount, $paymentStatus, $couponCode, $couponValue, $discountType, $billingCycle) {
            $user = \App\Models\User::find($userId);
            if (!$user) return null;

            $duration = $billingCycle === 'yearly' ? now()->addYear() : now()->addMonth();

            $payment = Payment::create([
                'coupon_code' => $couponCode ?: null,
                'coupon_value' => $couponValue > 0 ? $couponValue : null,
                'payment_amount' => $paymentAmount,
                'discount_type' => in_array($discountType, ['fixed', 'percentage']) ? $discountType : null,
                'status' => 'active',
                'user_id' => $userId,
                'payment_status' => $paymentStatus,
                'transaction_id' => $orderId,
                'payment_type' => $paymentMethod,
                'start_date' => now(),
                'end_date' => $duration,
                'subscription_id' => $subscriptionId,
                'city' => $user->city,
                'state' => $user->state,
                'pincode' => $user->pincode,
                'country' => $user->country,
                'address' => $user->address,
            ]);

            if ($paymentStatus === 'SUCCESS') {
                $user->update([
                    'status' => 'paid',
                    'premium_end_date' => $duration,
                ]);

                $pdf = Pdf::loadView('pdf.invoice', ['payment' => $payment]);
                $filename = "invoice_{$payment->transaction_id}.pdf";
                Storage::put("public/invoices/{$filename}", $pdf->output());

                $payloadData = [
                    'phone' => $user->phone,
                    'pdf_path' => storage_path("app/public/invoices/{$filename}"),
                ];
                file_put_contents(storage_path('app/whatsapp-invoice-payload.json'), json_encode($payloadData));

                try {
                    // RunWhatsAppInvoiceBotTest::dispatch();
                    Log::info('WhatsAppInvoiceBotTest job dispatched.');
                } catch (\Throwable $e) {
                    Log::error('Failed to dispatch WhatsAppInvoiceBotTest job: ' . $e->getMessage());
                }
            }

            return $payment;
        });
    }
}

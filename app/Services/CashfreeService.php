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
        $subscriptionId = 'sub_' . rand(1, 1000) . '_' . time();

        $baseUrl = env('DRISHTI_PULSE_ENV') === 'local'
            ? 'https://sandbox.cashfree.com/pg/subscriptions'
            : 'https://api.cashfree.com/pg/subscriptions';

        $response = Http::withHeaders([
            'x-client-id' => config('services.cashfree.key'),
            'x-client-secret' => config('services.cashfree.secret'),
            'x-api-version' => '2025-01-01',
            'Content-Type' => 'application/json',
        ])->post($baseUrl, [
            'subscription_id' =>  $subscriptionId,
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
                'return_url' => route('payment.thank-you'),
                'notification_email' => $validated['email'],
            ],
        ]);

        if($response->successful()){
            session()->flash('subscription_details', [
                'subscription_id' => $subscriptionId,
                'plan_name' => $validated['plan_name'],
                'amount' => $validated['amount'],
                'billing_cycle' => $validated['billing_cycle'],
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'payment_status' => 'Pending' // Will be updated via webhook
            ]);
        }
        // $json = $response->json();

        // Optional: handle failure
        if (!$response->successful()) {
            Log::info(json_encode($response->body()));
            throw new \Exception($json['message'] ?? 'Cashfree API error');
        }

        return $response->json();
        
    } catch (\Exception $e) {
        Log::error('Cashfree Subscription API Failed', [
            'userId' => auth()->id(),
            'error' => $e->getMessage()
        ]);
        
        throw $e;
    }
}


public function verifySignatureInReturnUrl(array $postData, string $receivedSignature): bool
{
    $secretKey = config('services.cashfree.secret');
    
    if (empty($secretKey)) {
        throw new \RuntimeException('Cashfree secret key not configured');
    }

    // 1. Remove signature from verification
    unset($postData['signature']);

    // 2. Sort keys alphabetically (case-sensitive)
    ksort($postData, SORT_STRING);

    // 3. Prepare values with exact formatting Cashfree uses
    $postDataString = '';
    foreach ($postData as $key => $value) {
        // Convert all values to string representation that matches Cashfree's format
        $stringValue = match(true) {
            is_bool($value) => $value ? 'true' : 'false',
            $value === null => '',
            $value === 'N/A' => '',
            default => (string)$value
        };
        $postDataString .= $stringValue;
    }

    // 4. Generate HMAC-SHA256 hash
    $hashHmac = hash_hmac('sha256', $postDataString, $secretKey, true);

    // 5. Base64 encode the hash
    $computedSignature = base64_encode($hashHmac);

    Log::debug('Cashfree Signature Verification Details', [
        'received' => $receivedSignature,
        'generated' => $computedSignature,
        'concatenatedString' => $postDataString,
        'sortedData' => $postData
    ]);

    // 6. Securely compare signatures
    return hash_equals($computedSignature, $receivedSignature);
}

public function verifyWebhookSignature(string $payload, ?string $timestamp, ?string $receivedSignature): bool
{
    $clientSecret = config('services.cashfree.secret');
    
    if (empty($clientSecret)) {
        throw new \RuntimeException('Cashfree client secret not configured');
    }

    if (empty($timestamp) || empty($receivedSignature)) {
        Log::error('Missing required headers for signature verification');
        return false;
    }

 
    $signedPayload = $timestamp . $payload;

    $expectedSignature = base64_encode(
        hash_hmac('sha256', $signedPayload, $clientSecret, true)
    );

    // Log::debug('Signature Verification', [
    //     'received' => $receivedSignature,
    //     'expected' => $expectedSignature,
    //     'signedPayload' => $signedPayload
    // ]);

    return hash_equals($expectedSignature, $receivedSignature);
}


// public function getSubscriptionDetails($subscriptionId)
// {
//     $response = Http::withHeaders([
//         'x-client-id' => config('services.cashfree.key'),
//         'x-client-secret' => config('services.cashfree.secret'),
//         'x-api-version' => '2025-01-01',
//         'Content-Type' => 'application/json',
//     ])->get("https://sandbox.cashfree.com/pg/subscriptions/{$subscriptionId}");

//     if(!$response->successful()){
//         throw new \Exception('Failed to fetch subscription details');
//     }

//     // Log::info('cashfree subscription details', ['response' => $response->json()]);
//     return $response->json();
// }

public function cancelSubscription($subscriptionId)
{
    $user = auth()->user();

    $response = Http::withHeaders([
        'x-client-id' => config('services.cashfree.key'),
        'x-client-secret' => config('services.cashfree.secret'),
        'x-api-version' => '2025-01-01',
        'Content-Type' => 'application/json',
    ])->post(
        (env('DRISHTI_PULSE_ENV') === 'local')?
        "https://sandbox.cashfree.com/pg/subscriptions/{$subscriptionId}/manage":
        "https://api.cashfree.com/pg/subscriptions/{$subscriptionId}/manage",
        [
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
        'status' => $subscriptionData['subscription_status'] ?? 'CANCELLED',
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

}

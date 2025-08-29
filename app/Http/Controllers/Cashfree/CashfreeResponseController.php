<?php

namespace App\Http\Controllers\Cashfree;

use App\Http\Controllers\Controller;
use App\Models\Monitors;
use App\Services\CashfreeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserSubscription;
use App\Models\Subscriptions;
use Carbon\Carbon;
use App\Models\Payment;
use Minishlink\WebPush\Subscription;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Mail\InvoiceEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;


class CashfreeResponseController extends Controller
{
    public function handleResponse(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        // Log::info('Cashfree Subscription POST Data:', $data);

        // $signature = $data['signature'] ?? '';
        // $isValidSignature = app(CashfreeService::class)->verifySignatureInReturnUrl($data, $signature);

        // if (!$isValidSignature) {
        //     Log::error('Invalid Cashfree signature. Potential forgery attempt.');
        //         abort(403, 'Invalid signature');
        // }

        try{

            // $subscription = app(CashfreeService::class)->getSubscriptionDetails($data['cf_subscriptionId']);

            // // 
            // Log::info('Cashfree Subscription Details after payment', $subscription);

            // // updating the table
            // $nextScheduleDate = isset($subscription['next_schedule_date']) 
            // ? Carbon::parse($subscription['next_schedule_date'])->format('Y-m-d H:i:s')
            // : null;

            // $updateData =[
            //     'next_schedule_date' => $nextScheduleDate,
            //     'payment_group' => $subscription['authorization_details']['payment_group'] ?? null,
            //     'payment_method' => $subscription['authorization_details']['payment_method'] ?? null,
            //     'status' => $subscription['subscription_status'] ?? 'ACTIVE'
            // ];

            // $updateUserTable=[
            //     'status'=>'paid',
            //     'premium_end_date'=>Carbon::parse($subscription['subscription_expiry_time'])->toDateString(),
            // ];

            // User::where('id', $user->id)->update($updateUserTable);
            // UserSubscription::where('cashfree_subscription_id', $subscription['subscription_id'])->update($updateData);

                
            //     $planId = $subscription['plan_details']['plan_id'];
            //     $subscriptionPrimarykey = Subscriptions::where('plan_id', $planId)->first();

            //     $paymentData=[
            //         'subscription_id' =>$subscriptionPrimarykey->id,
            //         'cashfree_subscription_id' => $subscription['subscription_id'],
            //         'payment_id' => $subscription['authorization_details']['payment_id'],
            //         'user_id' => $user->id,
            //         'coupon_code' =>  null,
            //         'coupon_value' =>  null,
            //         'payment_amount' => $subscription['authorization_details']['authorization_amount'],
            //         'discount_type'=> null,
            //         'status' => 'active',
            //         'payment_status' => $subscription['subscription_status'],
            //         'transaction_id' => $subscription['authorization_details']['authorization_reference'],
            //         'payment_type' => $subscription['authorization_details']['payment_group'],
            //         'start_date' => now(),
            //         'end_date' => Carbon::parse($subscription['subscription_expiry_time'])->toDateString(),
            //         'address_1' => $user->address_1, 
            //         'address_2' => $user->address_2, 
            //         'place' => $user->place, 
            //         'state' => $user->state,
            //         'pincode' => $user->pincode,
            //         'country'=> $user->country,
            //         'district' => $user->district,
            //         'gstin' => $user->gstin,
            //     ];

            //     $payment = Payment::create($paymentData);
            //     Monitors::where('user_id', $user->id)->update(['pause_on_expire' => 0]);

            //     $filename = "invoice_{$user->phone}.pdf";
            //     $pdfPath = "public/invoices/{$filename}";
                
            //     $subscriptionId = UserSubscription::where('cashfree_subscription_id', $payment->cashfree_subscription_id)->first();
                
            //     $pdf = Pdf::loadView('pdf.invoice', [
            //         'payment' => $payment,
            //         'user' => $user,
            //         'subscription' => $subscriptionId,
            //     ]);
        
            // Storage::put($pdfPath, $pdf->output());
        
            // Mail::to($user->email)->queue(new InvoiceEmail($pdfPath, $user, $payment));
            
            $subscriptionDetails = session('subscription_details');
        
            if (!$subscriptionDetails) {
                return redirect()->route('home')->with('error', 'Invalid payment session');
            }
            return view('cashfree.thank-you', [
                'details' => $subscriptionDetails
            ]);
            
            // return redirect()->route('monitoring.dashboard')->with('success', 'Subscription is active.');

        }catch(\Exception $e){

            // Log::error('Cashfree Subscription Error:', ['error' => $e->getMessage()]);
            return redirect()->route('monitoring.dashboard')->with('error', 'An error occurred while processing the subscription: ' . $e->getMessage());
        }
        // return view('cashfree.subscription-complete', ['data' => $data]);
    }


    public function handleWebhook(Request $request)
    {
       try {

        $payload = $request->getContent();
        $data = json_decode($payload, true);
        $timestamp = $request->header('x-webhook-timestamp');
        $signature = $request->header('x-webhook-signature');

        Log::info('Cashfree Webhook Received:', [
            'payload' => $data,
        ]);


        $isValid = app(CashfreeService::class)->verifyWebhookSignature(
            $payload,
            $timestamp,
            $signature
        );

        if (!$isValid) {
            // Log::error('Invalid Cashfree webhook signature');
            abort(403, 'Invalid signature');
        }

        // Process webhook events
        switch ($data['type'] ?? null) {
            case 'SUBSCRIPTION_PAYMENT_NOTIFICATION_INITIATED':
                $this->handlePaymentInitiated($data['data']);
                break;
            case 'SUBSCRIPTION_AUTH_STATUS':
                $this->handleAuthStatus($data['data']);
                break;
            
            case 'SUBSCRIPTION_STATUS_CHANGED':
                $this->handleStatusChange($data['data']);
                break;

            case 'SUBSCRIPTION_PAYMENT_SUCCESS':
                $this->handlePaymentSuccess($data['data']);
                break;
                
            case 'SUBSCRIPTION_PAYMENT_FAILED':
                $this->handlePaymentFailed($data['data']);
                break;
                
            default:
                // Log::warning('Unhandled webhook event', ['event' => $data['event_type'] ?? 'unknown']);
        }

        return response()->json(['status' => 'processed']);

    } catch (\Exception $e) {
        // Log::error('Webhook processing error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    private function handleStatusChange(array $data)
    {
        // Log::info('cashfree status change data', $data);

        $userSubscription = UserSubscription::where('cashfree_subscription_id', $data['subscription_details']['subscription_id'])->first();

        $user= User::find($userSubscription->user_id);

        $nextScheduleDate = isset($data['subscription_details']['next_schedule_date']) 
            ? Carbon::parse($data['subscription_details']['next_schedule_date'])->format('Y-m-d H:i:s')
            : null;

            $updateData =[
                'next_schedule_date' => $nextScheduleDate,
                'payment_group' => $data['authorization_details']['payment_group'] ?? null,
                'payment_method' => $data['authorization_details']['payment_method'] ?? null,
                'status' => $data['subscription_details']['subscription_status'] ?? 'ACTIVE'
            ];

            $updateUserTable=[
                'status'=>'paid',
                'premium_end_date'=>Carbon::parse($data['subscription_details']['subscription_expiry_time'])->toDateString(),
            ];

            User::where('id', $user->id)->update($updateUserTable);
            UserSubscription::where('cashfree_subscription_id', $data['subscription_details']['subscription_id'])->update($updateData);         

    }


    private function handlePaymentSuccess(array $data)
    {
        // Log::info('cashfree successfull data', $data);
                    
                $userSubscription = UserSubscription::where('cashfree_subscription_id', $data['subscription_id'])->first();
                $user = User::find($userSubscription->user_id);

                $userSubscription = UserSubscription::where('cashfree_subscription_id', $data['subscription_id'])->first();
                $endDate = $userSubscription?->end_date;
                $subscriptionId = $userSubscription?->subscription_id;

                $paymentData=[
                    // subscription_id means subscriptios table in DB primary key (plan table)
                    'subscription_id' =>$subscriptionId,
                    'cashfree_subscription_id' => $data['subscription_id'],
                    'payment_id' => $data['authorization_details']['payment_id'],
                    'user_id' => $user->id,
                    'coupon_code' =>  null,
                    'coupon_value' =>  null,
                    'payment_amount' => $data['authorization_details']['authorization_amount'],
                    'discount_type'=> null,
                    'status' => 'active',
                    'payment_status' => $data['payment_status'],
                    'transaction_id' => $data['cf_txn_id'],
                    'payment_type' => $data['authorization_details']['payment_group'],
                    'start_date' => now(),
                    'end_date' => $endDate,
                    'address_1' => $user->address_1, 
                    'address_2' => $user->address_2, 
                    'place' => $user->place, 
                    'state' => $user->state,
                    'pincode' => $user->pincode,
                    'country'=> $user->country,
                    'district' => $user->district,
                    'gstin' => $user->gstin,
                ];

                $payment = Payment::create($paymentData);

                $updateUserTable=[
                    'status'=>'paid',
                    'premium_end_date'=> $endDate,
                ];

                User::where('id', $user->id)->update($updateUserTable);
                Monitors::where('user_id', $user->id)->update(['pause_on_expire' => 0]);

                $filename = "invoice_{$data['cf_txn_id']}.pdf";
                // $pdfPath = "public/invoices/{$filename}";
                $pdfPath = 'storage/invoices/' . $filename;
                
                $subscriptionId = UserSubscription::where('cashfree_subscription_id', $payment->cashfree_subscription_id)->first();
                
                $pdf = Pdf::loadView('pdf.invoice', [
                    'payment' => $payment,
                    'user' => $user,
                    'subscription' => $subscriptionId,
                ]);
        

            if (!file_exists(public_path('storage/invoices'))) {
                mkdir(public_path('storage/invoices'), 0777, true);
            }
            // Storage::put($pdfPath, $pdf->output());
            $pdf->save(public_path($pdfPath));

            Mail::to($user->email)->queue(new InvoiceEmail($pdfPath, $user, $payment));
            // save to invoice table

            Invoice::create([
                'user_id' => $user->id,
                'billing_name'=> $user->name,
                'invoice_number' => $data['cf_txn_id'],
                'invoice_date' => now(),
                'tax_amount' => 0,
                'file_path' => $pdfPath,
            ]);
    }

    private function handleAuthStatus(array $data)
    {
        // Log::info('cashfree auth status data', $data);

        
    }

    private function handlePaymentFailed(array $data)
    {
        // Log::info('cashfree payment failed data', $data);

    }

    private function handlePaymentInitiated(array $data)
    {
        // Log::info('cashfree payment initiated Data', $data);
    }

    

}

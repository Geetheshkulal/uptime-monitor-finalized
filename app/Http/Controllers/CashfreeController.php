<?php

namespace App\Http\Controllers;

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


class CashfreeController extends Controller
{
    public function handleResponse(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        Log::info('Cashfree Subscription POST Data:', $data);

        try{
            $subscription = app(CashfreeService::class)->getSubscriptionDetails($data['cf_subscriptionId']);

            // 
            Log::info('Cashfree Subscription Details after payment', $subscription);

            // updating the table
            $nextScheduleDate = isset($subscription['next_schedule_date']) 
            ? Carbon::parse($subscription['next_schedule_date'])->format('Y-m-d H:i:s')
            : null;

            $updateData =[
                'next_schedule_date' => $nextScheduleDate,
                'payment_group' => $subscription['authorization_details']['payment_group'] ?? null,
                'payment_method' => $subscription['authorization_details']['payment_method'] ?? null,
                'status' => $subscription['subscription_status'] ?? 'ACTIVE'
            ];

            $updateUserTable=[
                'status'=>'paid',
                'premium_end_date'=>Carbon::parse($subscription['subscription_expiry_time'])->toDateString(),
            ];

            User::where('id', $user->id)->update($updateUserTable);
            UserSubscription::where('cashfree_subscription_id', $subscription['subscription_id'])->update($updateData);

                
                $planId = $subscription['plan_details']['plan_id'] ;
                $subscriptionPrimarykey = Subscriptions::where('plan_id', $planId)->first();

                $paymentData=[
                    // subscription_id means subscriptios table in DB primary key (plan table)
                    'subscription_id' =>$subscriptionPrimarykey->id,
                    'cashfree_subscription_id' => $subscription['subscription_id'],
                    'user_id' => $user->id,
                    'coupon_code' =>  null,
                    'coupon_value' =>  null,
                    'payment_amount' => $subscription['authorization_details']['authorization_amount'],
                    'discount_type'=> null,
                    'status' => 'active',
                    'payment_status' => $subscription['subscription_status'],
                    'transaction_id' => $subscription['authorization_details']['authorization_reference'],
                    'payment_type' => $subscription['authorization_details']['payment_group'],
                    'start_date' => now(),
                    'end_date' => Carbon::parse($subscription['subscription_expiry_time'])->toDateString(),
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

                // return $this->testDownload($payment, $user);
            return redirect()->route('monitoring.dashboard')->with('success', 'Subscription is active.');

        }catch(\Exception $e){

            Log::error('Cashfree Subscription Error:', ['error' => $e->getMessage()]);
            return redirect()->route('monitoring.dashboard')->with('error', 'An error occurred while processing the subscription: ' . $e->getMessage());
        }
        // return view('cashfree.subscription-complete', ['data' => $data]);
    }


    // public function testDownload($payment, $user)
    public function testDownload()
    {
        $payment = Payment::latest()->first();

        if (!$payment) {
            return "No payment record found.";
        }
    
        // Fetch the user associated with this payment
        $user = User::find($payment->user_id);
    
        if (!$user) {
            return "User not found for this payment.";
        }
        $pdf = Pdf::loadView('pdf.invoice', [
            'payment' => $payment,
            'user' => $user
        ]);
    
        $filename = "invoice_{$user->phone}.pdf";
    
        // Save to storage
        Storage::put("public/invoices/{$filename}", $pdf->output());

        return $pdf->download($filename);
    }
    

}

<?php

namespace App\Http\Controllers\Cashfree;

use App\Http\Controllers\Controller;
use App\Jobs\RunWhatsAppInvoiceBotTest;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Payment;
use Illuminate\Support\Facades\Redirect;
use App\Models\CouponUser;
use App\Models\CouponCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Services\CashfreeService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;

class CashFreePaymentController extends Controller
{
    public function create(Request $request)
    {
        return view('payment-create');
    }

    
    public function store(Request $request,CashfreeService $cashfree)
    {
        try{
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'mobile' => 'required',
            'plan_id' => 'required|string',
            'plan_name' => 'required|string',
            'plan_type' => 'required|in:PERIODIC,ON_DEMAND',
            'plan_currency' => 'required|string',
            'plan_recurring_amount' => 'required_if:plan_type,PERIODIC|nullable|numeric',
            'amount' => 'required|numeric',
            'subscription_id' => 'required',
            'billing_cycle' => 'required|in:monthly,yearly'
        ]);
    } catch (\Exception $e) {
            // Log::error('Validation failed', $e->errors());
            return back()->with('error', 'Validation failed: ' . $e->getMessage());
        }

        $user = auth()->user();

        try {
            
            $response = $cashfree->createSubscription($validated);
            
            // Log::info('Cashfree Subscription Response:', $response);

            // save in user_subscriptions table
            UserSubscription::create([
                'user_id' => $user->id,
                'subscription_id' => $validated['subscription_id'],
                'plan_name' =>  $response['plan_details']['plan_name'] ?? null,
                'authorization_amount' =>  $response['authorization_details']['authorization_amount'] ?? null,
                'plan_type' => $response['plan_details']['plan_type'] ?? null,
                'plan_recurring_amount' => $response['plan_details']['plan_recurring_amount'] ?? null,
                'plan_max_amount' => $response['plan_details']['plan_max_amount'] ?? null,
                'plan_interval_type' =>  $response['plan_details']['plan_interval_type'] ?? null,
                'cashfree_subscription_id' => $response['subscription_id'] ?? null,
                'start_date' => now(),
                'end_date' => ($response['plan_details']['plan_interval_type'] === 'MONTH')?null:now()->addYear(),
                'status' => $response['subscription_status'] ?? 'INITIALIZED',
                'payment_group' => $response['authorization_details']['payment_group'] ?? null,
                'next_schedule_date' => $response['next_schedule_date'] ?? null,
                'payment_method' => $response['authorization_details']['payment_method'] ?? null,
            ]);

            return response()->json([
                'subscription_session_id' => $response['subscription_session_id'] ?? null,
            ]);

        } catch (\Exception $e) {
            
            return response()->json([
                'error' => 'Failed to create subscription',
                'message' => $e->getMessage()
            ], 500);
        }
        
    }


    public function cancelSubscription(Request $request, $subscriptionId, CashfreeService $cashfree)
    {
        try {
            $result = $cashfree->cancelSubscription($subscriptionId);
            
             return redirect()->route('planSubscription')->with('success', 'Subscription Cancelled Successfully!');
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


}

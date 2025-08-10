<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class UserSubscriptionController extends Controller
{
    public function DisplayUserSubscription()
    {
        $subscriptions = UserSubscription::with('user')->latest()->get();
    
        return view('pages.admin.DisplayUserSubscription',compact('subscriptions'));
    }
    public function DetailUserSubscription($cashfree_subscription_id)
    {
        $subscription = UserSubscription::with('user')
                        ->where('cashfree_subscription_id', $cashfree_subscription_id)
                        ->firstOrFail();    
        
        // Fetch payment details from Cashfree API
        $payments = [];
        try {
            $response = Http::withHeaders([
                'x-client-id' => config('services.cashfree.key'),
                'x-client-secret' => config('services.cashfree.secret'),
                'x-api-version' => '2025-01-01'
            ])->get(config('services.cashfree.details_url')."/{$cashfree_subscription_id}/payments");

            if ($response->successful()) {
                $payments = $response->json();
            }
        } catch (\Exception $e) {
            Log::error('Error fetching payment details: ' . $e->getMessage());
        }

        return view('pages.admin.DetailUserSubscription', [
            'subscription' => $subscription,
            'payments' => $payments
        ]);
    }
}
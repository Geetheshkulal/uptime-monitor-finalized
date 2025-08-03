<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\Log;

class PremiumPageController extends Controller
{
    public function PremiumPage(){

        $plans = Subscriptions::where('is_active', 1)->get();
        $user = auth()->user();
  
        $jspricingData = $plans->map(function ($plan) {
        
            $monthly = $plan->amount;
            
            $yearly = $plan->amount * 12;
            if ($plan->yearly_discount) {
                $yearly = $yearly - ($yearly * ($plan->yearly_discount / 100));
            }

            return [
                'id' => $plan->id,
                'monthly' => round($monthly, 2),
                'yearly' => round($yearly, 2),
                'yearly_discount' => $plan->yearly_discount,
                'billing_cycle' => $plan->billing_cycle,
                'active' => $plan->is_active,
            ];
        });

        if ($plans->isEmpty()) {
            Log::error("No active subscription plans found.");
            return back()->with('error', 'Subscription plans not available.');
        }

        return view('pages.premium', compact('plans', 'user', 'jspricingData'));
    }

    // public function PremiumPage(){
    //     $plans = Subscriptions::all();
    //     $user = auth()->user();
  
    //   if (!$plans) {
    //       Log::error("Subscription plan with ID 1 not found.");
    //       return back()->with('error', 'Subscription plan not available.');
    //   }
  
    //   Log::info("Plan Data: ", $plans->toArray()); 

    //   return view('pages.premium',compact('plans','user'));
    // }
}

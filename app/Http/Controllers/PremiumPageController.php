<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\Log;

class PremiumPageController extends Controller
{
    public function PremiumPage(){

        $plans = Subscriptions::where('is_active', 1)->get();
        $user = auth()->user();

        if ($plans->isEmpty()) {
            Log::error("No active subscription plans found.");
            return back()->with('error', 'Subscription plans not available.');
        }

        return view('pages.premium', compact('plans', 'user'));
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

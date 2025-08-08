<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserSubscription;

//Payments controller for user payments table else redirect to plans page
class PlanSubscriptionController extends Controller
{
  public function planSubscription(Request $request)
  {
    
    
      $userId = Auth::id();
      // $subscriptions = Payment::where("user_id", $userId)
      //                        ->orderBy('created_at', 'desc')
      //                        ->get();
      $subscriptions = UserSubscription::where("user_id", $userId)
      ->orderBy('created_at', 'desc')
      ->get();

      $payments = Payment::where("user_id", $userId)
              ->orderBy('created_at', 'desc')
              ->get()
              ->keyBy('cashfree_subscription_id');

      $count = $subscriptions->count();
  
  
      // if ($count > 0) {
      //     return view('pages.planSubscription', compact('subscriptions'));
      // } else {
      //     return redirect()->route('premium.page');
      // }
      return view('pages.planSubscription', compact('subscriptions', 'payments'));
  }
}
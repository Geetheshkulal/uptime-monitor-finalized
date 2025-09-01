<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AddPlanService;
use Log;


class BillingController extends Controller
{
    
    public function Billing(){
        $subscriptions = Subscriptions::all();
        $basic_plan = Subscriptions::where('plan_id', 'plan_basic')->first();
        if (!$basic_plan) {
            Log::warning('Basic plan (plan_id: plan_basic) not found in subscriptions table.');
            return view('pages.admin.Billing', compact('subscriptions'))
                ->with(['ErrorMessage' => 'Basic plan (plan_id: plan_basic) not found. May cause errors']);        }
        return view('pages.admin.Billing', compact('subscriptions'));
    }

     // Add new subscription
     public function AddBilling(Request $request, AddPlanService $cashfree)
     {
         $validated = $request->validate([
            'plan_id' => 'required|unique:subscriptions,plan_id|max:100',
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,yearly',
            // 'plan_type' => 'required|in:PERIODIC,ON_DEMAND',
            'plan_recurring_amount' => 'nullable|numeric',
            'yearly_discount' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'sometimes|boolean',

            'percentage_discount' => 'nullable|numeric|min:0|max:100',
            'sale_price' => 'nullable|numeric|min:0|lte:amount',
        ],[
            'yearly_discount.max' => 'Yearly discount cannot be more than 100.',
            'percentage_discount.max' => 'Percentage discount cannot be more than 100.',
            'percentage_discount.min' => 'Percentage discount cannot be less than 0.',
            'sale_price.lte' => 'Sale price cannot be greater than the original amount.',
            'sale_price.min' => 'Sale price cannot be negative.',
        ]);

     
        $validated['plan_currency'] = 'INR';
        
        $response = $cashfree->createPlan($validated);

        if (isset($response['code']) && $response['code'] !== 'success') {
            return back()->withErrors([$response['message'] ?? 'Plan creation failed'])->withInput();
        }
   
         Subscriptions::create([
            'plan_id' => $validated['plan_id'],
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'plan_type' =>  $validated['billing_cycle'] === 'monthly' ? 'PERIODIC':'ON_DEMAND',
            'percentage_discount' => $validated['percentage_discount'] ? $validated['percentage_discount'] : null,
            'sale_price' => $validated['sale_price'],
            'billing_cycle' => $validated['billing_cycle'],
            'plan_recurring_amount' => $validated['sale_price'],
            'is_active' => $validated['is_active'] ?? true,
         ]);
     
         return redirect()->back()->with('success', 'Subscription added successfully');
     }

       // Update billing amount
    public function EditBilling(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'billing_cycle' => 'required|in:monthly,yearly',
            'yearly_discount' => 'nullable|numeric',
            'is_active' => 'boolean'
        ],
    );

        $subscription = Subscriptions::findOrFail($id);
        $subscription->update($validated);

        

        return redirect()->back()->with('success', 'Subscription edited successfully');
    }

    public function destroy($id)
    {
        $subscription = Subscriptions::findOrFail($id);
        $subscription->delete();

        activity()
            ->performedOn($subscription)
            ->causedBy(auth()->user())
            ->inLog('Subscription Management') 
            ->event('deleted')
            ->withProperties([
                'user_name' => auth()->user()->name,
                'coupon_code' => $subscription->name,
            ])
            ->log("Deleted Coupon: {$subscription->name}");

        return back()->with('success', 'Subscription deleted successfully.');
    }

     // Toggle active status
     public function ToggleActive(Request $request, $id){
        $subscription = Subscriptions::findOrFail($id);

        
         // If basic plan is being deactivated, pause all free users' monitors
        if($subscription->plan_id==='plan_basic'){
            $free_users = User::where('status', 'free')->get();
            if($request->is_active==='false'){
                Log::info($subscription);
                // Deactivate all users on basic plan
            
                foreach ($free_users as $user) {
                    $user->monitors()->update(['pause_on_expire' => true]);
                }
            }else{
                foreach ($free_users as $user) {
                    $userMonitors = $user->monitors()
                    ->orderBy('created_at', 'desc')
                    ->get();

                    $monitorsToKeep = $userMonitors->take(5)->pluck('id');
                    $monitorsToPause = $userMonitors->slice(5)->pluck('id');

                    if ($monitorsToKeep->isNotEmpty()) {
                        $user->monitors()
                            ->whereIn('id', $monitorsToKeep)
                            ->update(['pause_on_expire' => false]);
                    }

                    if ($monitorsToPause->isNotEmpty()) {
                        $user->monitors()
                            ->whereIn('id', $monitorsToPause)
                            ->update(['pause_on_expire' => true]);
                    }
                }
            }
        }
        $subscription->update(['is_active' => !$subscription->is_active]);

        return response()->json(['success' => true, 'is_active' => $subscription->is_active]);
    }

    public function EditFeature(Subscriptions $subscription)
    {
        
        /// Initialize with empty array if no features exist
        $features = $subscription->features ?? [];

        return view('pages.admin.EditPlanFeatures', [
            'subscription' => $subscription,
            'features' => $features
        ]);

    }

    public function UpdateFeature(Request $request, Subscriptions $subscription)
    {
        $validated = $request->validate([
            // Other validation rules...
            'features' => 'nullable|array',
            'features.*.name' => 'required|string',
            'features.*.available' => 'required|boolean'
        ]);
    
        // Format features correctly
        $features = [];
        foreach ($request->input('features', []) as $feature) {
            $features[] = [
                'name' => $feature['name'],
                'available' => (bool)$feature['available']
            ];
        }
    
        $subscription->update([
            // Other fields...
            'features' => $features
        ]);

    return redirect()->route('admin.features.edit', ['subscription' => $subscription->id])
        ->with('success', 'Subscription plan updated successfully');
}

}

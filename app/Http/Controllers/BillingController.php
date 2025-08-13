<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Http\Request;
use App\Services\AddPlanService;


class BillingController extends Controller
{
    
    public function Billing(){
        $subscriptions = Subscriptions::all();
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
             'plan_type' => 'required|in:PERIODIC,ON_DEMAND',
             'plan_recurring_amount' => 'nullable|numeric',
             'yearly_discount' => 'nullable|numeric|min:0|max:100',
             'is_active' => 'sometimes|boolean',
         ],[
            'yearly_discount.max' => 'Yearly discount cannot be more than 100.',
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
             'plan_type' => $validated['plan_type'],
             'billing_cycle' => $validated['billing_cycle'],
             'plan_recurring_amount' => $validated['plan_recurring_amount'],
             'yearly_discount' => $validated['yearly_discount'] ? $validated['yearly_discount'] : null,
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

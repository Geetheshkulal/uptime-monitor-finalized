<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    // Link to the payment (if needed)
    protected $fillable=[
        'plan_id',
        'name',
        'amount',
        'slug',
        'plan_type',
        'percentage_discount',
        'sale_price',
        'plan_recurring_amount',
        'billing_cycle',
        'monthly_discount',
        'yearly_discount',
        'is_active',
        'created_at',
        'updated_at',
        'description',
        'features' ,
    ];

    protected $casts = [
        'features' => 'array'
    ];
    public function payment()
    {
        
        return $this->hasOne(Payment::class, 'subscription_id');
    }
}
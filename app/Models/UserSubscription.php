<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'start_date',
        'end_date',
        'status',
        'cancelled_at',
        'authorization_amount',
        'plan_name',
        'plan_type',
        'plan_recurring_amount',
        'plan_max_amount',
        'plan_interval_type',
        'cashfree_subscription_id',
        'next_schedule_date',
        'payment_method',
        'payment_group'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'cancelled_at' => 'datetime',
        'authorization_amount' => 'decimal:2',
        'plan_recurring_amount' => 'decimal:2',
        'plan_max_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BasicPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'id' => 1,
            'plan_id' => 'plan_basic',
            'name' => 'Basic',
            'amount' => 0,
            'percentage_discount' => 0,
            'sale_price' => 0,
            'plan_type' => 'PERIODIC',
            'features' => json_encode([
                [
                    'name' => 'Monitor 5 websites',
                    'available' => true
                ],
                [
                    'name' => '5-minute check',
                    'available' => true
                ],
                [
                    'name' => 'Email alerts',
                    'available' => true
                ],
                [
                    'name' => '1-Month history',
                    'available' => true
                ],
                [
                    'name' => 'Telegram bot alert unavailable',
                    'available' => false
                ],
                [
                    'name' => 'SSL expiry check unavailable',
                    'available' => false
                ],
                [
                    'name' => 'Create and manage team members unavailable',
                    'available' => false
                ]
            ]),
            'plan_recurring_amount' => 0,
            'slug' => 'basic',
            'description' => 'Ideal for small businesses and startup projects',
            'billing_cycle' => 'monthly',
            'yearly_discount' => 0,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
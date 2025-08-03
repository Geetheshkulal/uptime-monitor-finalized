<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AddPlanService
{
    protected $baseUrl = 'https://sandbox.cashfree.com/pg/plans';

    // protected function headers()
    // {
    //     return [
    //         'x-client-id' => config('services.cashfree.key'),
    //         'x-client-secret' => config('services.cashfree.secret'),
    //         'Content-Type' => 'application/json',
    //     ];
    // }

    public function createPlan($data)
    {
        try {
            $response = Http::withHeaders([
                'x-api-version' => '2025-01-01',
                'x-client-id' => config('services.cashfree.key'),
                'x-client-secret' => config('services.cashfree.secret'),
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}", [
                "plan_id" => $data['plan_id'],
                "plan_name" => $data['name'],
                "plan_type" => $data['plan_type'],
                "plan_max_amount" => (float) $data['amount'],
                "plan_currency" => $data['plan_currency'],
                "plan_recurring_amount" => (float) $data['plan_recurring_amount'] ,
                "plan_interval_type" => $data['billing_cycle'] === 'monthly' ? 'MONTH' : 'YEAR',
            ]);
    
            if ($response->failed()) {
                Log::error('Cashfree Plan Creation Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'input' => $data,
                ]);
    
                $message = $response->json()['message'] ?? 'Cashfree API Plan Creation Failed.';
                throw new \Exception($message);
                
            }
    
            return $response->json();
    
        } catch (\Throwable $e) {
            Log::error('Exception during Cashfree Plan Creation', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $data,
            ]);
    
            throw $e; 
        }
    }
}

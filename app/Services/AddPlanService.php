<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AddPlanService
{
    // protected $baseUrl = 'https://sandbox.cashfree.com/pg/plans';
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('DRISHTI_PULSE_ENV') === 'local'
            ? 'https://sandbox.cashfree.com/pg/plans'
            : 'https://api.cashfree.com/pg/plans';
    }

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
                "plan_type" => 'PERIODIC',
                "plan_max_amount" => (float) $data['sale_price'],
                "plan_currency" => $data['plan_currency'],
                "plan_recurring_amount" => (float) $data['sale_price'] ,
                "plan_interval_type" => $data['billing_cycle'] === 'monthly' ? 'MONTH' : 'YEAR',
                "plan_max_cycles" => $data['billing_cycle'] === 'monthly' ? 12 : 1,
                "plan_intervals" => 1
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

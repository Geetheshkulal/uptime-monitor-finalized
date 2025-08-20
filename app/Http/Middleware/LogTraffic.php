<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\TrafficLog;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LogTraffic
{

    public function handle(Request $request, Closure $next)
{
    // Exclude common static/service-worker paths
    $excludedPaths = [
        'favicon.ico',
        'robots.txt',
        'service-worker.js',
        'sw.js',
        'firebase-messaging-sw.js',
        'manifest.json',
        'css/*',
        'js/*',
        'images/*',
        'fonts/*',
        'storage/*',
    ];

    foreach ($excludedPaths as $path) {
        if ($request->is($path)) {
            return $next($request);
        }
    }

    $response = $next($request);

    // Only log unauthenticated users
    if (!Auth::check()) {
        $agent = new Agent();
        $ip = $request->ip();
        $isp = 'Unknown ISP';
        $country = 'Unknown';

        try {
            $token = env('IPINFO_TOKEN');
            $ipResponse = Http::get("https://ipinfo.io/{$ip}?token={$token}");

            if ($ipResponse->successful()) {
                $data = $ipResponse->json();
                $isp = $data['org'] ?? 'Unknown ISP';
                $country = $data['country'] ?? 'Unknown';
            }
        } catch (\Exception $e) {
            // Log::error('IP Info fetch error: ' . $e->getMessage());
        }

        // $log = new TrafficLog();
        // $log->ip = $request->ip();
        // $log->user_agent = $request->userAgent();
        // $log->isp = $isp;
        // $log->country = $country;
        // $log->browser = $agent->browser();
        // $log->platform = $agent->platform();
        // $log->referrer = $request->headers->get('referer');
        // $log->url = $request->fullUrl();
        // $log->method = $request->method();
        // $log->save();

        
        $logData = [
            'ip' => $ip,
            'user_agent' => $request->userAgent(),
            'isp' => $isp,
            'country' => $country,
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'referrer' => $request->headers->get('referer'),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
        ];

        // inject context from controller
        $logData['status'] = $request->session()->get('traffic_status', 'visit');
        $logData['reason'] = $request->session()->get('traffic_reason');
        $logData['name'] = $request->session()->get('traffic_name');
        $logData['email'] = $request->session()->get('traffic_email');

        $probableUser = User::where('last_login_ip', $ip)->first();

        if ($probableUser) {
            $logData['type']  = 'probable user';
            $logData['name']  = $probableUser->name;
            $logData['email'] = $probableUser->email;
        }

        // Log::info('Traffic Log Data in middleware: ', $logData);

        // if($request->is('login') && $request->isMethod('post')){
        //     $logData['email'] = $request->input('email');
        //     $logData['status'] = 'login_attempt';
        // }

        // if ($request->is('register') && $request->isMethod('post')) {
        //     $logData['email'] = $request->input('email');
        //     $logData['status'] = 'register_attempt';
        // }

        // TrafficLog::create(attributes: $logData);
        TrafficLog::create($logData);
    }

    // return $next($request);
   return $response;
}

    // public function handle(Request $request, Closure $next)
    // {
   
    // if (!Auth::check()) {
    //     $agent = new Agent();
    //     $ip = $request->ip();
    //     Log::info('IP Address: ' . $ip);
    //     $isp = 'Unknown ISP'; 

    //     try{
    //         $token=env('IPINFO_TOKEN');
    //         $response=Http::get("https://ipinfo.io/{$ip}?token={$token}");
    //         Log::info($response->json());

    //         if($response->successful()){
    //             $data=$response->json();
    //             $isp = $data['org'] ?? 'Unknown ISP'; 
    //             $country = $data['country'] ?? '';
    //         }      
    //     }catch(\Exception $e){

    //     }
            
    //     $log = new TrafficLog();
    //     $log->ip = $request->ip();
    //     $log->user_agent = $request->userAgent();
    //     $log->isp = $isp;
    //     $log->country = $country;
    //     $log->browser = $agent->browser();
    //     $log->platform = $agent->platform();
    //     $log->referrer = $request->headers->get('referer');
    //     $log->url = $request->fullUrl();
    //     $log->method = $request->method();
    //     $log->save();

    // }

    //     return $next($request);
       
    // }
}

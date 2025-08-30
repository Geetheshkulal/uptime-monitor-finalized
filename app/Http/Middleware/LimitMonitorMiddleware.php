<?php

namespace App\Http\Middleware;

use App\Models\Subscriptions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//Limit free Users to 5 monitors
class LimitMonitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Skip check for paid users and superadmins
        if ($user->status !== 'free' || $user->hasRole('superadmin')) {
            return $next($request);
        }

        // Check if free user has reached monitor limit
        $monitorCount = $user->monitors()->count();
        $basic_plan = Subscriptions::where('plan_id', 'plan_basic')
                        ->first();
        
        if ($user->hasRole('user') && $user->status === 'free' &&  ($monitorCount >= 5 || !$basic_plan->is_active)) {
            return redirect()->route('premium.page')
                ->with('warning', 'You have reached the limit of 5 monitors on the free plan. Upgrade to premium to add more monitors.');
        }

        return $next($request);
    }
}
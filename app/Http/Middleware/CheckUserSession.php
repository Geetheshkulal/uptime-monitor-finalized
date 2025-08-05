<?php

namespace App\Http\Middleware;

use App\Models\PushSubscription;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

//To prevent same user login from multiple devices at the same time.
class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user(); //Get current user
        
        if ($user) {
            $sessionId = Session::getId(); //Get sessionId
            
            // If user's session_id doesn't match current session
            if (!empty($user->session_id) && $user->session_id !== $sessionId) {
                PushSubscription::where('user_id', $user->id)->delete();

                Log::info('Redirecting with error message', [
                    'error' => 'Logged out from other device2',
                    'user_id' => $user->id,
                ]);

                Auth::logout();

                return redirect('login')->with('error', 'Logged out from other device');
            }
        }
        
        return $next($request);
    }
}
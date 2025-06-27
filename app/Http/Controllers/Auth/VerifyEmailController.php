<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Mail\EmailVerifiedThankYouMail;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with('success', 'Your email is verified!');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            Mail::to($request->user()->email)->send(new EmailVerifiedThankYouMail($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with('success', 'Successfully registered!');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            User::find('id', Auth::id())->update(['activated' => 1]);
            
            return redirect()->intended(route('user-profile.edit', absolute: false))
                ->with('success', 'ایمیل شما با موفقیت فعال شد');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('user-profile.edit', absolute: false))
            ->with('success', 'ایمیل شما با موفقیت فعال شد');
    }
}

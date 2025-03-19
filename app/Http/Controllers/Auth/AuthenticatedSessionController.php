<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\Otp;
use App\Models\User\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Sms\SmsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login-otp');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $identifier = $request->input('identifier');
        $loginType = $request->input('login_type');


        // پیدا کردن کاربر
        $user = User::where('email', $identifier)
            ->orWhere('mobile', $identifier)
            ->first();

        if (!$user) {
            return back()->withErrors(['error' => 'کاربری با این مشخصات پیدا نشد']);
        }

        if ($loginType === 'password') {
            // تلاش برای ورود با رمز ثابت
            $credentials = [
                filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile' => $identifier,
                'password' => $request->input('password'),
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate(); // بازتولید سشن برای امنیت
                $user->update(['activated'=>1]);
                return redirect()->intended(route('home', absolute: false));
            } else {
                return back()->withErrors(['error' => 'اطلاعات ورود نامعتبر است']);
            }
        } else {
            // ورود با رمز یکبار مصرف
            $otp =rand(1000, 9999); // یه کد 4 رقمی
            // $expiresAt = now()->addMinutes(10); // انقضا بعد از ۱۰ دقیقه
            $token = Str::random(32);
            // ذخیره OTP
            Otp::create([
                'token' => $token,
                'user_id' => $user->id,
                'otp_code' => $otp,
                'used' => 0,
                'attempts' => 0,
            ]);

            // ارسال OTP
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                // ارسال ایمیل
                try{
                    Mail::raw("رمز یکبار مصرف شما: $otp", function ($message) use ($identifier) {
                        $message->to($identifier)
                            ->subject('رمز یکبار مصرف');
                    });
                }
                catch (\Exception $e) {
                    return redirect()->back()->with('error', 'خطا در ارسال کد' . $e->getMessage());
                }

            } else {
                // ارسال پیامک
                try{   $smsService = new SmsService();
                    $smsService->sendSmsOtp($identifier, "رمز یکبار مصرف شما: $otp");
                }
                catch (\Exception $e) {
                    return redirect()->back()->with('error', 'خطا در ارسال کد' . $e->getMessage());
                }
             
            }

            // انتقال به صفحه وارد کردن OTP
            
            return redirect()->route('otp.verify.form', ['token' => $token])->with('message', 'کد ارسال شد');        }

        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

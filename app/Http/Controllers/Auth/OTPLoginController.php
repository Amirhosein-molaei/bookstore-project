<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use App\Models\User\Otp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Sms\SmsService;
use App\Http\Controllers\Controller;
use App\Mail\otpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OTPLoginController extends Controller
{
    public function loginUser(Request $request)
    {
      $request->validate([
            'identifier' => [
                'required',
                'regex:/^(09[0-9]{9}|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/'
            ],
            
            'login_type' => ['required', 'in:password,otp'],
            'password' => ['required_if:loginType,password'],
        ]);

        $identifier = $request->input('identifier');
        $loginType = $request->input('login_type');


        // پیدا کردن کاربر
        $user = User::where('email', $identifier)
            ->orWhere('mobile', $identifier)
            ->first();
        if (!$user) {
            return redirect()->back()->with('error', '    کاربری با این مشخصات پیدا نشد.');
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
                return redirect()->back()->with('error', '  اطلاعات ورود نامعتبر');
            }
        } else {

            $oldOtp = Otp::where('user_id', $user->id)->first();

                // if ($oldOtp && $oldOtp->created_at->diffInMinutes(now()) < 3) {
                //     return back()->with('error', 'لطفاً 3 دقیقه صبر کنید و سپس مجدداً درخواست کد دهید.');
                // }

            $oldOtp ? $oldOtp->delete() : "";
            // ورود با رمز یکبار مصرف
            $code = rand(1000, 9999); // یه کد 4 رقمی
            $expires_at = now()->addMinutes(3)->toDateTimeString(); // انقضا بعد از 3 دقیقه
            $token = Str::random(32);
            // ذخیره OTP
            $otp = Otp::create([
                'token' => $token,
                'user_id' => $user->id,
                'otp_code' => $code,
                'used' => 0,
                'attempts' => 0,
                'expires_at' => $expires_at
            ]);

            // ارسال OTP
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                // ارسال ایمیل
                try {
                    Mail::to($user->email)->send(new otpMail($otp));
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', 'ارسال ایمیل با خطا مواجه شد. لطفا دوباره اقدام کنید' . $th->getMessage());
                }
            } else {
                // ارسال پیامک
                try {
                    $smsService = new SmsService();
                    $smsService->sendSmsOtp($identifier, $otp->otp_code);
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'خطا در ارسال کد' . $e->getMessage());
                }
            }

            // انتقال به صفحه وارد کردن OTP

            return redirect()->route('otp.verify.form', ['token' => $token])->with('success', 'کد تایید برای شما ارسال شد');
        }
    }

    public function showVerifyForm($token)
    {

        $otp = Otp::where('token', $token)->first();
        if (!$otp || $otp->used) {
            return redirect()->route('login')->with('error', 'کد نامعتبر');
        }
        return view('auth.verify-otp', ['token' => $token]);
    }
    public function verifyOtp(Request $request)
    {

        $request->validate([
            'token' => 'required|exists:otps,token',
            'otp' => 'required|digits:4',
        ]);



        $otp = Otp::where('token', $request->input('token'))->first();

        if (!$otp || $otp->used) {
            return redirect()->route('login')->with('error', 'کد نامعتبر');
        }

        if ($otp->attempts >= 3) {
            return redirect()->route('login')->with('error', 'تعداد تلاش های شما بیش از حد مجاز است');
        }

        if ($otp->otp_code != $request->input('otp')) {
            $otp->increment('attempts');
            return redirect()->back()->with('error', 'کد وارد شده اشتباه است');
        }
        if ($otp->expires_at < now()) {
            return redirect()->route('login')->with('error', '  تاریخ انقضای کد وارد شده به پایان رسیده است.');
        }

        $otp->update(['used' => 1]);

        $user = $otp->user;
        $user->update(['activated'=>1]);

        Auth::login($user);

        return redirect()->route('app.home')->with('success', 'ورود با موفقیت انجام شد');
    }
}

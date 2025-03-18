<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\Otp;
use App\Models\User\User;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OTPLoginController extends Controller
{
    protected $smsService;
    
    public function __construct(SmsService $sms) {
        $this->smsService = $sms;
    }

    public function showOtp()
    {
        return view('auth.login-otp');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'contact' => 'required|string'
        ]);

        $contact = $request->input('contact');

        // delete old otp's
        
        $otpCode = rand(1000, 9999);
        $token = Str::random(32);
        $otpCode = random_int(1000, 9999);
        
        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            # send mail
        } elseif (preg_match('/^09[0-9]{9}$/', $contact)) {
            // find user by mobile or create it, if it doesn't exsist
            $user = User::firstOrCreate(['mobile' => $contact], ['mobile' => $contact, 'otp_method' => 0]);
            // dd('g');
            Otp::where('user_id', $user->id)->delete();

            Otp::create([
                'token' => $token,
                'user_id' => $user->id,
                'otp_code' => $otpCode,
                'used' => 0,
                'attempts' => 0,
            ]);

            // send sms
            $this->smsService->sendOtpSms($contact, $otpCode);
            return to_route('otp.verify.form', ['token' => $token])->with('message', 'کد تایید برای شما پیامک شد');
        }
    }

    public function showVerifyForm($token)
    {
        $otp = Otp::where('token', $token)->first();
        // if otp is used or token is wrong user will be redirected back to login
        if (!$otp or $otp->used) {
            return redirect()->route('login')->with('error', 'کد نامعتبر');
        }
        
        return view('auth.verify-otp', ['token' => $token]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:otps,token',
            'otp' => 'required|digits:4'
        ]);
                
        $otp = Otp::where('token', $request->input('token'))->first();
        
        if (!$otp or $otp->used) {
            return redirect()->route('otp.show')->with('error', 'کد نامعتبر');
        }
        
        if ($otp->attempts >= 3) {
            return redirect()->route('otp.show')->with('error', 'تعداد تلاش های شما بیش از حد مجاز است. لطفا مجددا اقدام به دریافت کد تایید کنید');
        }
        
        if ($otp->otp_code != $request->input('otp')) {
            $otp->increment('attempts');
            return redirect()->back()->with('error', 'کد وارد شده اشتباه است');
        }

        $otp->update(['used' => 1]);

        $user = $otp->user;
        Auth::login($user);

        redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // اعتبارسنجی ورودی
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'identifier' => ['required', 'string', 'max:255', 'regex:/^([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}|09[0-9]{9})$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // detect identifier type 
        if (filter_var($request->identifier, FILTER_VALIDATE_EMAIL)) {
            $email = $request->identifier;
            $mobile = null;
            $existingUser = User::where('email', $email)->exists();
        } else {
            $email = null;
            $mobile = $request->identifier;
            $existingUser = User::where('mobile', $mobile)->exists();
        }

    
        if ($existingUser) {
            return redirect()->route('register')->withErrors(['identifier' => 'ایمیل یا شماره موبایل وارد شده تکراری است']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect()->route('login')->with('success', $user->name . ' عزیز، به بوک خونه خوش آمدید:)');
    }
}

<!doctype html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ورود / ثبت نام</title>

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />
</head>

<body>

    @include('app.layouts.partials.icons')

    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="relative mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Return -->
                <a href="./login.html"
                    class="absolute -top-3.5 -right-3.5 hover:dark:bg-muted shadow-base hover:bg-muted text-white hover:text-primary transition-all duration-200 hover: w-10 h-10 flex items-center justify-center rounded-full bg-primary">
                    <svg class="w-8 h-8">
                        <use xlink:href="#chevron-right" />
                    </svg>
                </a>
                <!-- Logo -->
                <a href="./index.html">
                    <img src="./assets/images/logo.svg" class="mx-auto mb-10 w-40" alt="" />
                </a>
                <h1 class="mb-10 text-lg">کلمه عبور را وارد کنید</h1>
                <form action="{{ route('login') }}" method="post" class="my-4">
                    @csrf
                    <div class="mb-4 space-y-4">
                        <label for="email" class="relative block rounded-lg border shadow-base">
                            <input type="email" id="email" name="email" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-left placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="ایمیل" value="{{ old('email') }}" required autofocus autocomplete="username"/>
    
                            <span
                                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                ایمیل
                            </span>
                        </label>
                        <label for="password" class="relative block rounded-lg border shadow-base">
                            <input type="password" id="password" name="password" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-left placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="کلمه عبور" value="{{ old('password') }}" required autocomplete="current-password"/>
    
                            <span
                                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                کلمه عبور
                            </span>
                        </label>
                        <p class="h-5 text-sm text-red-500 dark:text-red-400">
                            @error('email')
                                {{ $message }}
                            @enderror
                            <br>
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div>
                        <button type="submit" class="btn-primary w-full py-3">ورود</button>
                    </div>
                </form>
                
                <ul class="mb-8 space-y-4">
                    <li>
                        <a href="{{ route('otp.show') }}" class="btn-primary-nobg text-sm w-fit">
                            <span>ورود با رمز یک بار مصرف</span>
                            <span>
                                <svg class="h-5 w-5">
                                    <use xlink:href="#chevron-left" />
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('password.request') }}" class="btn-primary-nobg text-sm w-fit">
                            <span> فراموشی رمز عبور </span>
                            <span>
                                <svg class="h-5 w-5">
                                    <use xlink:href="#chevron-left" />
                                </svg>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

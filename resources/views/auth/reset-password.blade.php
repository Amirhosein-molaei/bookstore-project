{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!doctype html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ورود / ثبت نام</title>

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />

    <script src=" {{ asset('assets/scripts/mount.js') }}"></script>
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
                <form action="">
                    <div class="mb-4 space-y-4">
                        <label for="username" class="relative block rounded-lg border shadow-base">
                            <input type="password" id="username" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-left placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="کلمه عبور" />

                            <span
                                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                            </span>
                        </label>
                        <label for="username" class="relative block rounded-lg border shadow-base">
                            <input type="password" id="username" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-left placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="تایید کلمه عبور" />

                            <span
                                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                            </span>
                        </label>
                        <p class="h-5 text-sm text-red-500 dark:text-red-400">
                            <!-- کلمه عبور اشتباه میباشد -->
                        </p>
                    </div>
                    <div>
                        <button class="btn-primary w-full py-3">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

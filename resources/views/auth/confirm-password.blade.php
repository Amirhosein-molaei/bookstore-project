<!doctype html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>تایید رمز عبور</title>

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />

    <script src=" {{ asset('assets/scripts/mount.js') }}"></script>
</head>

<body>

    @include('app.layouts.partials.icons')
    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="mx-auto mb-10 w-40" alt="لوگو" />
                </a>
                <h1 class="mb-5 text-center text-lg">تأیید رمز عبور</h1>
                <p class="mb-10 text-center text-sm text-text/90">
                    این بخش امن برنامه است. لطفاً رمز عبور خود را برای ادامه تأیید کنید.
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="mb-4 space-y-4">
                        <!-- رمز عبور -->
                        <label for="password" class="relative block rounded-lg border shadow-base">
                            <input type="password" id="password" name="password" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="رمز عبور" required autocomplete="current-password" />
                            <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                رمز عبور
                            </span>
                        </label>
                        @error('password')
                            <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mb-5">
                        <button type="submit" class="btn-primary py-3 px-6">تأیید</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
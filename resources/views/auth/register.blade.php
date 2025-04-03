<!doctype html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ثبت نام</title>

    <link href=" {{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/app.css') }}" rel="stylesheet" />
    <link href=" {{ asset('assets/css/theme.css') }}" rel="stylesheet" />

    <script src=" {{ asset('assets/scripts/mount.js') }}"></script>
</head>

<body>
    @include('app.layouts.partials.icons')

    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="mx-auto max-w-[900px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="mx-auto mb-10 w-40" alt="لوگو" />
                </a>
                <h1 class="mb-5 text-center text-lg">ثبت نام</h1>
                <p class="mb-10 text-center text-sm text-text/90">لطفاً اطلاعات خود را وارد کنید</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- نام -->
                        <div>
                            <label for="name" class="relative block rounded-lg border shadow-base">
                                <input type="text" id="name" name="name" dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="نام کامل" required value="{{ old('name') }}" />
                                <span
                                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    نام
                                </span>
                            </label>
                            @error('name')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- شماره موبایل -->
                        <div>
                            <label for="identifier" class="relative block rounded-lg border shadow-base">
                                <input value="{{ old(key: 'identifier') }}" type="text" id="identifier" name="identifier"
                                    dir="auto" inputmode="numeric"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="ایمیل یا شماره موبایل" />
                                <span
                                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    ایمیل یا شماره موبایل
                                </span>
                            </label>
                            @error('identifier')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رمز عبور -->
                        <div>
                            <label for="password" class="relative block rounded-lg border shadow-base">
                                <input type="password" id="password" name="password" dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="رمز عبور" required />
                                <span
                                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    رمز عبور
                                </span>
                            </label>
                            @error('password')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- تایید رمز عبور -->
                        <div>
                            <label for="password_confirmation" class="relative block rounded-lg border shadow-base">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="تایید رمز عبور" required />
                                <span
                                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    تایید رمز عبور
                                </span>
                            </label>
                            @error('password_confirmation')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn-primary w-full py-3">ثبت نام</button>
                    </div>
                </form>

                <!-- لینک ورود -->
                <p class="text-center text-sm text-text/90">
                    قبلاً ثبت‌نام کرده‌اید؟
                    <a href="{{ route('login') }}" class="text-primary">وارد شوید</a>
                </p>

                @if (session('error'))
                    <div class="mt-4 text-center text-sm text-red-500 dark:text-red-400">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>

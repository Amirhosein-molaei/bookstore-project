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
            <div class="mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="mx-auto mb-10 w-40" alt="لوگو" />
                </a>
                <h1 class="mb-10 text-center text-lg">ورود | ثبت نام</h1>
                <p class="mb-5 text-center text-sm text-text/90">نوع ورود خود را انتخاب کنید.</p>

                <form action="{{ route('loginUser') }}" method="POST">
                    @csrf
                    <div class="mb-4 space-y-4">
                        <!-- نوع ورود -->
                        <label for="login_type" class="relative block rounded-lg border shadow-base p-2">
                            <select name="login_type" id="login_type"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-right focus:outline-none focus:ring-0"
                                required>
                                <option value="password">ورود با رمز ثابت</option>
                                <option value="otp" selected>ورود با رمز یکبار مصرف</option>
                            </select>
                            <span
                                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-focus:text-sm">
                                نوع ورود
                            </span>
                        </label>
                        @error('login_type')
                            <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <!-- شماره موبایل یا ایمیل -->
                        <label for="identifier" class="relative block rounded-lg border shadow-base">
                            <input type="text" id="identifier" name="identifier" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="شماره موبایل یا ایمیل" required />
                            <span
                                class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                شماره موبایل یا ایمیل
                            </span>
                        </label>
                        @error('identifier')
                            <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <!-- رمز عبور -->
                        <div id="password_field" style="display: none;">
                            <label for="password" class="relative block rounded-lg border shadow-base">
                                <input type="password" id="password" name="password" dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="رمز عبور" />
                                <span
                                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    رمز عبور
                                </span>
                            </label>
                            @error('password')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn-primary w-full py-3">ورود</button>
                    </div>
                </form>

                <!-- قوانین و لینک‌ها -->

                <div class="mt-3 text-center text-sm">
                    <a href="{{ route('register') }}" class="text-primary block">ثبت نام</a>
                    <a href="{{ route('password.request') }}" class="text-primary block"> فراموشی رمز عبور / بازیابی از
                        طریق ایمیل</a>
                    <p class="mt-2 text-text/90">اگر رمز عبور خود را فراموش کرده‌اید، می‌توانید از روش رمز یکبار مصرف
                        نیز استفاده کنید.</p>
                </div>

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
<!-- اسکریپت برای نمایش/مخفی کردن فیلد رمز عبور -->
<script>
    document.getElementById('login_type').addEventListener('change', function() {
        const passwordField = document.getElementById('password_field');
        if (this.value === 'password') {
            passwordField.style.display = 'block';
            document.getElementById('password').setAttribute('required', 'required');
        } else {
            passwordField.style.display = 'none';
            document.getElementById('password').removeAttribute('required');
        }
    });
</script>

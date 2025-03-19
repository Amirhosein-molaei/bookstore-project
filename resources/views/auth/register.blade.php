@extends('auth.layouts.master')

@section('title', 'ثبت نام')

@section('content')
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
                                <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    نام
                                </span>
                            </label>
                            @error('name')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- شماره موبایل -->
                        <div>
                            <label for="mobile" class="relative block rounded-lg border shadow-base">
                                <input value="{{ old(key: 'mobile') }}" type="text" id="mobile" name="mobile" dir="auto" inputmode="numeric"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="شماره موبایل"  />
                                <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    شماره موبایل
                                </span>
                            </label>
                            @error('mobile')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ایمیل -->
                        <div>
                            <label for="email" class="relative block rounded-lg border shadow-base">
                                <input value="{{ old('email') }}" type="email" id="email" name="email" dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="ایمیل" />
                                <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    ایمیل
                                </span>
                            </label>
                            @error('email')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- کد ملی -->
                        <!-- <div>
                            <label for="national_code" class="relative block rounded-lg border shadow-base">
                                <input type="text" id="national_code" name="national_code" dir="auto" inputmode="numeric"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="کد ملی" required />
                                <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    کد ملی
                                </span>
                            </label>
                            @error('national_code')
                                <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div> -->

                        <!-- رمز عبور -->
                        <div>
                            <label for="password" class="relative block rounded-lg border shadow-base">
                                <input type="password" id="password" name="password" dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="رمز عبور" required />
                                <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
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
                                <input type="password" id="password_confirmation" name="password_confirmation" dir="auto"
                                    class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="تایید رمز عبور" required />
                                <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
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
@endsection
@section('scripts')
@parent
@if (session('swal-success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'موفقیت',
        text: '{{ session("swal-success") }}',
    });
</script>
@endif

@if (session('swal-error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'خطا',
        text: '{{ session("swal-error") }}',
    });
</script>
@endif
@show
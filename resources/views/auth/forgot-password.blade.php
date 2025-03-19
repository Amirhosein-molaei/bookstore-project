@extends('auth.layouts.master')

@section('title', 'فراموشی رمز عبور')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="mx-auto mb-10 w-40" alt="لوگو" />
                </a>
                <h1 class="mb-5 text-center text-lg">فراموشی رمز عبور</h1>
                <p class="mb-10 text-center text-sm text-text/90">
                    لطفاً ایمیل    خود را وارد کنید تا لینک بازیابی رمز عبور برای شما ارسال شود.
                </p>

                <!-- نمایش وضعیت ارسال ایمیل -->
                @if (session('status'))
                    <div class="mb-5 text-center text-sm text-green-500 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-4 space-y-4">
                        <!-- ایمیل -->
                        <label for="email" class="relative block rounded-lg border shadow-base">
                            <input type="email" id="email" name="email" dir="auto" 
                                class="peer w-full  rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="ایمیل   خود را وارد کنید" required autofocus />
                            <!-- <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                ایمیل
                            </span> -->
                        </label>
                        @error('email')
                            <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn-primary w-full py-3">ارسال لینک بازیابی</button>
                    </div>
                </form>

                <!-- لینک بازگشت -->
                <p class="text-center text-sm text-text/90">
                    <a href="{{ route('login') }}" class="text-primary">بازگشت به صفحه ورود</a>
                </p>
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
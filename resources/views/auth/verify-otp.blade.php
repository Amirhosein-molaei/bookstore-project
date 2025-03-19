@extends('auth.layouts.master')

@section('title', 'تایید')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-background">
        <div class="container">
            <div class="mx-auto max-w-[450px] rounded-xl bg-muted p-5 shadow-base md:p-10">
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="mx-auto mb-10 w-40" alt="لوگو" />
                </a>
                <h1 class="mb-5 text-center text-lg">تایید کد</h1>
                <p class="mb-10 text-center text-sm text-text/90">
                    لطفاً کد تأیید را وارد نمایید
                </p>

                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4 space-y-4">
                        <!-- کد تأیید -->
                        <label for="otp" class="relative block rounded-lg border shadow-base">
                            <input type="text" id="otp" name="otp" dir="auto"
                                class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                                placeholder="کد" required />
                            <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                کد تأیید
                            </span>
                        </label>
                        @error('otp')
                            <p class="h-5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn-primary w-full py-3">تأیید</button>
                    </div>
                </form>

                <!-- پیام خطا -->
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
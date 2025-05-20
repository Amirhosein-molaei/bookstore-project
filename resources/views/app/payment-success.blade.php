@extends('app.layouts.master')
@use('Morilog\Jalali\Jalalian')
@section('title', 'پرداخت موفق')

@section('content')
    <div class="container">
        <div class="mx-auto max-w-[500px] rounded-lg bg-muted p-5">
            <!-- Head -->
            <div class="flex flex-col items-center justify-center gap-y-4">
                <div>
                    <svg class="h-20 w-20 text-primary">
                        <use xlink:href="#check" />
                    </svg>
                </div>
                <h1 class="mb-8 text-center text-base text-primary md:text-lg lg:text-xl">
                    @if (isset($wallet))
                        شارژ کیف پول موفقیت آمیز بود
                    @else
                        پرداخت سفارش {{ $order->id }} موفق بود!
                    @endif
                </h1>
            </div>

            <div class="mb-6 flex items-center justify-center text-sm">
                <div class="flex flex-col items-center gap-y-2 md:gap-y-4">
                    <p class="font-medium md:text-lg">جرئیات پرداخت</p>
                    <div class="flex items-center gap-x-4">
                        <p class="text-text/90">
                            @if (isset($wallet))
                                تاریخ : <span> {{ Jalalian::forge($wallet->updated_at)->format('%B %d، %Y') }}</span>
                            @else
                                تاریخ : <span> {{ Jalalian::forge($order->created_at)->format('%B %d، %Y') }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex gap-x-4">
                <div class="w-full ">
                    @if (isset($order))
                        <a href="{{ route('user-profile.order-details', $order) }}" class="btn-primary py-3"> پیگیری سفارش
                        </a>
                    @else
                        <a href="{{ route('user-profile.wallet') }}" class="btn-primary py-3"> کیف پول
                        </a>
                    @endif
                </div>
                <div class="w-full">
                    <a href="{{ route('app.home') }}" class="btn-secondary py-3"> خانه </a>
                </div>
            </div>
        </div>
    </div>
@endsection

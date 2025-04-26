@use('Morilog\Jalali\Jalalian')
@extends('app.profile.layouts.master')
@section('title', 'جزئیات سفارش')

@section('content')
    <!-- content -->
    <div class="col-span-12 lg:col-span-9">
        <div class="rounded-lg bg-muted p-5 shadow-base">
            <div class="mb-16 flex flex-col items-center justify-between gap-y-8 xs:flex-row">
                <!-- Title -->
                <h1 class="relative w-fit text-xl font-medium">
                    جزئیات سفارش {{ $order->id }}#
                    <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                    </span>
                </h1>

                <a href="{{ route('user-profile.orders') }}" class="btn-secondary w-full px-4 py-2 xs:w-fit">
                    برگشت
                    <svg class="h-5 w-5">
                        <use xlink:href="#chevron-left" />
                    </svg>
                </a>
            </div>
            @if ($order->payment_status)
                <div class="mb-8">
                    <div class="rounded-lg border shadow-base">
                        <div class="p-4">
                            <!-- head -->
                            <div class="flex items-center justify-between pb-6">
                                <div
                                    class="flex items-center gap-x-2 {{ $order->order_status == 1 ? 'text-primary' : 'text-red-500 dark:text-red-400' }}">
                                    <svg class="h-6 w-6">
                                        <use xlink:href="{{ $order->order_status == 1 ? '#outline-check' : '' }}"></use>
                                    </svg>
                                    <p class="font-medium md:text-lg">
                                        {{ $order->order_status == 1 ? 'پرداخت شده' : 'لغو شده' }}</p>
                                </div>
                            </div>

                            <!-- conent -->
                            <div class="flex flex-col gap-6 pb-6 xl:flex-row xl:justify-between xl:gap-16">
                                <div class="flex flex-col gap-4 md:flex-row">

                                    <div class="flex items-center justify-between gap-x-2 md:justify-start">
                                        <div class="text-sm text-text/60 md:text-base">
                                            مبلغ کل
                                        </div>
                                        <div class="text-primary">
                                            <span
                                                class="font-bold md:text-lg">{{ number_format($order->order_final_amount) }}</span>
                                            <span class="text-sm md:text-base">تومان</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between gap-x-2 md:justify-start">
                                        <div class="text-sm text-text/60 md:text-base">
                                            تاریخ
                                        </div>
                                        <div class="text-sm text-text/90 md:text-base">
                                            {{ Jalalian::forge($order->created_at)->format('%B %d، %Y') }}
                                        </div>
                                    </div>
                                </div>
                                @if ($order->order_status == 1)
                                    <div class="flex flex-grow flex-col gap-y-4">
                                        <!-- order status -->
                                        <div class="flex items-center gap-x-2 text-primary">
                                            <p class="text-sm font-medium md:text-base">
                                                تکمیل شده
                                            </p>
                                        </div>
                                        <!-- order step -->

                                        <div class="relative h-2 w-full rounded-full bg-background dark:bg-zinc-800">
                                            <span class="absolute inset-y-0 right-0 rounded-full bg-primary"
                                                style="width: 100%">
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex flex-grow flex-col gap-y-4">
                                        <!-- order status -->
                                        <div class="flex items-center gap-x-2 text-red-500 dark:text-red-400">
                                            <svg class="h-5 w-5 md:h-6 md:w-6">
                                                <use xlink:href="#order-canceled"></use>
                                            </svg>
                                            <p class="text-sm font-medium md:text-base">
                                                لغو شده
                                            </p>
                                        </div>
                                        <!-- order step -->

                                        <div class="relative h-2 w-full rounded-full bg-background dark:bg-zinc-800">
                                            <span class="absolute inset-y-0 right-0 rounded-full bg-warning dark:bg-red-400"
                                                style="width: 100%"></span>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mb-8">
                    <div class="rounded-lg border p-4 shadow-base">
                        <!-- head -->

                        <div class="flex flex-col items-center justify-between gap-4 pb-6 xs:flex-row">
                            <div class="flex items-center gap-x-2 text-yellow-500 dark:text-yellow-400">
                                <svg class="h-6 w-6">
                                    <use xlink:href="#warning"></use>
                                </svg>
                                <p class="font-medium md:text-lg">در انتظار پرداخت</p>
                            </div>

                            <a href="#" class="btn-primary w-full px-4 py-2 text-sm xs:w-32 xs:text-base">
                                پرداخت مجدد
                            </a>
                        </div>

                        <!-- conent -->
                        <div class="flex flex-col gap-6 lg:flex-row lg:justify-between xl:gap-16">
                            <div class="flex flex-col gap-4 md:flex-row">
                                <div class="flex items-center justify-between gap-x-2 md:justify-start">
                                    <div class="text-sm text-text/60 md:text-base">
                                        شماره سفارش
                                    </div>
                                    <div class="text-sm text-text/90 md:text-base">
                                        #{{ $order->id }}
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-x-2 md:justify-start">
                                    <div class="text-sm text-text/60 md:text-base">
                                        مبلغ کل
                                    </div>
                                    <div class="text-primary">
                                        <span
                                            class="font-bold md:text-lg">{{ number_format($order->order_final_amount) }}</span>
                                        <span class="text-sm md:text-base">تومان</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="mb-8">
                <div class="rounded-lg border p-4 shadow-base">
                    <div class="mb-6 flex flex-col gap-4 md:flex-row flex-wrap">
                        <div class="flex justify-between gap-x-2 lg:justify-start">
                            <div class="text-sm text-text/60 md:text-base">
                                مبلغ مرسوله
                            </div>
                            <div class="text-primary">
                                <span class="font-bold md:text-lg">{{ number_format($order->order_final_amount) }}</span>
                                <span class="text-sm md:text-base">تومان</span>
                            </div>
                        </div>
                        <div class="flex justify-between gap-x-2 lg:justify-start">
                            <div class="text-sm text-text/60 md:text-base">
                                تخفیف کالا ها
                            </div>
                            <div class="text-red-500 dark:text-red-400">
                                <span
                                    class="font-bold md:text-lg">{{ number_format($order->order_discount_amount) }}</span>
                                <span class="text-sm md:text-base">تومان</span>
                            </div>
                        </div>
                        <div class="flex justify-between gap-x-2 lg:justify-start">
                            <div class="text-sm text-text/60 md:text-base">
                                کد تخفیف
                            </div>
                            <div class="text-red-500 dark:text-red-400">
                                <span
                                    class="font-bold md:text-lg">{{ number_format($order->order_total_discount - $order->order_discount_amount) }}</span>
                                <span class="text-sm md:text-base">تومان</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 md:flex-row">

                    </div>
                </div>
            </div>
            <div class="mb-8">
                <h2 class="mb-8 flex items-center gap-x-4 text-lg text-text/90">
                    <span class="h-2 w-2 rounded-full bg-primary"></span>
                    اقلام سفارش
                    <span class="text-sm text-text/60"> ( {{ $order->orderItems->count() }} کالا ) </span>
                </h2>
                <ul class="divide-y">
                    @foreach ($order->orderItems as $item)
                        <!-- Cart Item-->
                        <li>
                            <div class="py-4 sm:py-6">
                                <div
                                    class="grid grid-cols-2 items-center justify-start gap-2 xs:grid-cols-3 xs:gap-6 sm:grid-cols-4 xl:grid-cols-6">
                                    <!-- Image -->
                                    <div class="row-span-2 min-w-fit xs:mx-auto">
                                        <a href="{{ route('product', $item->product) }}">
                                            <img alt="" class="w-25 rounded-lg sm:w-28"
                                                src="{{ asset($item->product->image) }}">
                                        </a>
                                    </div>
                                    <!-- Detail -->
                                    <div class="row-span-2 space-y-4 xs:col-span-2 sm:col-span-3 xl:col-span-5">
                                        <!-- Title -->
                                        <a class="line-clamp-2 text-sm md:text-base" href="{{ route('product', $item->product) }}">
                                            {{ $item->product->title }}
                                        </a>
                                        
                                        <div
                                            class="flex flex-col items-start gap-x-2 text-red-500 dark:text-red-400 xs:flex-row xs:items-center">
                                            <div class="text-xs xs:text-sm">تخفیف</div>
                                            <div class="text-red-500 dark:text-red-400">
                                                <span class="text-sm font-bold">{{ number_format($item->product->price - $item->product->discounted_price) }}</span>
                                                <span class="text-xs xs:text-sm">تومان</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Download Link -->
                                    <div class="flex items-center gap-x-2 xs:justify-center">
                                        <form method="post" action="" 
                                            class="h-10 w-24 rounded-lg border sm:w-28">
                                            @csrf
                                            <button type="submit" class="btn btn-indigo w-full h-full">
                                                دانلود
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Price -->
                                    <div class="row-span-2 xs:col-span-2 sm:col-span-3 xl:col-span-5">
                                        <div class="text-primary xs:col-span-2 sm:col-span-3 lg:text-lg xl:col-span-5">
                                            <span class="font-bold">{{ number_format($item->price) }}</span>
                                            <span class="text-sm lg:text-base">تومان</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

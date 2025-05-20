@use('Morilog\Jalali\Jalalian')
@extends('app.profile.layouts.master')
@section('title', 'سفارشات من')

@section('content')
    <!-- content -->
    <div class="col-span-12 lg:col-span-9">
        <div class="rounded-lg bg-muted p-5 shadow-base">
            <!-- Title -->
            <h1 class="relative mb-16 w-fit text-xl font-medium">
                سفارشات شما
                <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                </span>
            </h1>
            @if ($pendingOrders->count() > 0)
                <div class="mb-8">
                    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                        <h2 class="flex items-center gap-x-4 text-lg text-text/90">
                            <span class="h-2 w-2 rounded-full bg-primary"></span>
                            سفارشات در انتظار پرداخت
                        </h2>
                    </div>
                    <div class="space-y-4">
                        @foreach ($pendingOrders as $order)
                            <!-- order item -->
                            <div>
                                <a href="{{ route('user-profile.order-details', $order) }}">
                                    <div class="rounded-lg border p-4 shadow-base">
                                        <!-- head -->

                                        <div class="flex items-center justify-between pb-6">
                                            <div class="flex items-center gap-x-2 text-yellow-500 dark:text-yellow-400">
                                                <svg class="h-6 w-6">
                                                    <use xlink:href="#warning" />
                                                </svg>
                                                <p class="font-medium md:text-lg">
                                                    در انتظار پرداخت
                                                </p>
                                            </div>

                                            <svg class="h-6 w-6">
                                                <use xlink:href="#chevron-left" />
                                            </svg>
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
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mb-8">
                <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                    <h2 class="flex items-center gap-x-4 text-lg text-text/90">
                        <span class="h-2 w-2 rounded-full bg-primary"></span>
                        سفارشات
                    </h2>
                </div>
                <!-- Filter  Tabs -->
                <div class="mb-8">
                    <ul class="-mb-px flex justify-between gap-x-2 overflow-x-auto text-center text-sm font-medium scrollbar-thumb-transparent xs:justify-start xs:gap-x-4 xs:text-base"
                        data-tabs-toggle="#ordersFilterTab" id="ordersFilterTab" role="tablist">
                        <li role="presentation">
                            <button aria-controls="filter-delivered" aria-selected="false"
                                class="flex items-center gap-x-2 whitespace-nowrap rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover: text-text/90 dark:hover:text-zinc-300"
                                data-tabs-target="#filter-delivered" id="filter-delivered-tab" role="tab"
                                type="button">
                                تکمیل شده
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary text-base text-white dark:bg-emerald-600">
                                    {{ $finishedOrders->count() }}
                                </span>
                            </button>
                        </li>
                        <li role="presentation">
                            <button aria-controls="filter-canceled" aria-selected="false"
                                class="flex items-center gap-x-2 whitespace-nowrap rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover: text-text/90 dark:hover:text-zinc-300"
                                data-tabs-target="#filter-canceled" id="filter-canceled-tab" role="tab" type="button">
                                لغو شده
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary text-base text-white dark:bg-emerald-600">
                                    {{ $canceledOrders->count() }}
                                </span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div id="ordersFilterTab">
                    <div aria-labelledby="filter-delivered-tab" class="hidden" id="filter-delivered" role="tabpanel">
                        <div class="mb-8 space-y-4">
                            @forelse ($finishedOrders as $order)
                                <!-- order item -->
                                <div class="rounded-lg border shadow-base">
                                    <a href="{{ route('user-profile.order-details', $order) }}">
                                        <div class="p-4">
                                            <!-- head -->

                                            <div class="flex items-center justify-between pb-6">
                                                <div class="flex items-center gap-x-2 text-primary">
                                                    <svg class="h-6 w-6">
                                                        <use xlink:href="#outline-check" />
                                                    </svg>
                                                    <p class="font-medium md:text-lg">
                                                        پرداخت شده
                                                    </p>
                                                </div>

                                                <svg class="h-6 w-6">
                                                    <use xlink:href="#chevron-left" />
                                                </svg>
                                            </div>
                                            <!-- conent -->
                                            <div class="mb-6 flex flex-col gap-6 xl:flex-row xl:justify-between xl:gap-16">
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
                                                <div class="flex flex-grow flex-col gap-y-4">
                                                    <!-- order status -->
                                                    <div class="flex items-center gap-x-2 text-primary">
                                                        <p class="text-sm font-medium md:text-base">
                                                            تکمیل شده
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="relative h-2 w-full rounded-full bg-background dark:bg-zinc-800">
                                                        <span class="absolute inset-y-0 right-0 rounded-full bg-primary"
                                                            style="width: 100%"></span>
                                                    </div>
                                                    <!-- order step -->
                                                    <div
                                                        class="flex items-center justify-center text-sm text-primary md:text-base">
                                                        <span>
                                                            {{ Jalalian::forge($order->created_at)->format('%B %d، %Y') }}
                                                        </span>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- products slider -->
                                    <div class="swiper orders-product-swiper p-4">
                                        <div class="swiper-wrapper">
                                            @foreach ($order->orderItems as $item)
                                                <div class="swiper-slide">
                                                    <a class="flex items-center gap-x-2 rounded-lg border p-2"
                                                        href="{{ route('product', $item->product->slug) }}">
                                                        <img alt="" class="w-20 h-20 rounded"
                                                            src="{{ asset($item->product->image) }}" />
                                                        <p class="line-clamp-2 text-sm">
                                                            {{ $item->product->title }}
                                                        </p>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex justify-center">
                                    <div class="flex flex-col items-center justify-center gap-y-4 text-text/60">
                                        <svg class="h-20 w-20">
                                            <use xlink:href="#order-off"></use>
                                        </svg>
                                        <p class="md:text-xl">
                                            لیست سفارش های تکمیل شده خالی میباشد
                                        </p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div aria-labelledby="filter-canceled-tab" class="hidden" id="filter-canceled" role="tabpanel">
                        <div class="mb-8 space-y-4">
                            @forelse ($canceledOrders as $order)
                                <!-- order item -->
                                <div class="rounded-lg border shadow-base">
                                    <a href="{{ route('user-profile.order-details', $order) }}">
                                        <div class="p-4">
                                            <!-- head -->

                                            <div class="flex items-center justify-between pb-6">
                                                <div class="flex items-center gap-x-2 text-red-500 dark:text-red-400">
                                                    <svg class="h-6 w-6">
                                                        <use xlink:href="#order-canceled" />
                                                    </svg>
                                                    <p class="font-medium md:text-lg">
                                                        لغو شده
                                                    </p>
                                                </div>

                                                <svg class="h-6 w-6">
                                                    <use xlink:href="#chevron-left" />
                                                </svg>
                                            </div>
                                            <!-- conent -->
                                            <div class="mb-6 flex flex-col gap-6 xl:flex-row xl:justify-between xl:gap-16">
                                                <div class="flex flex-col gap-4 md:flex-row">
                                                    <div
                                                        class="flex items-center justify-between gap-x-2 md:justify-start">
                                                        <div class="text-sm text-text/60 md:text-base">
                                                            شماره سفارش
                                                        </div>
                                                        <div class="text-sm text-text/90 md:text-base">
                                                            #{{ $order->id }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex items-center justify-between gap-x-2 md:justify-start">
                                                        <div class="text-sm text-text/60 md:text-base">
                                                            مبلغ کل
                                                        </div>
                                                        <div class="text-primary">
                                                            <span
                                                                class="font-bold md:text-lg">{{ number_format($order->order_final_amount) }}</span>
                                                            <span class="text-sm md:text-base">تومان</span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex items-center justify-between gap-x-2 md:justify-start">
                                                        <div class="text-sm text-text/60 md:text-base">
                                                            تاریخ
                                                        </div>
                                                        <div class="text-sm text-text/90 md:text-base">
                                                            {{ Jalalian::forge($order->created_at)->format('%B %d، %Y') }}
                                                        </div>
                                                    </div>
                                                </div>
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
                                                    <!-- order status -->
                                                    <div
                                                        class="relative h-2 w-full rounded-full bg-background dark:bg-zinc-800">
                                                        <span
                                                            class="absolute inset-y-0 right-0 rounded-full bg-warning dark:bg-red-400"
                                                            style="width: 100%">
                                                        </span>
                                                    </div>
                                                    <!-- order date -->
                                                    <div
                                                        class="flex items-center justify-center text-sm text-red-500 dark:text-red-400 md:text-base">
                                                        <span>
                                                            {{ Jalalian::forge($order->created_at)->format('%B %d، %Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- products slider -->
                                    <div class="swiper orders-product-swiper p-4">
                                        <div class="swiper-wrapper">
                                            @foreach ($order->orderItems as $item)
                                                <div class="swiper-slide">
                                                    <a class="flex items-center gap-x-2 rounded-lg border p-2"
                                                        href="{{ route('product', $item->product) }}">
                                                        <img alt="" class="w-20 h-20 rounded"
                                                            src="{{ asset($item->product->image) }}" />
                                                        <p class="line-clamp-2 text-sm">
                                                            {{ $item->product->title }}
                                                        </p>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex justify-center">
                                    <div class="flex flex-col items-center justify-center gap-y-4 text-text/60">
                                        <svg class="h-20 w-20">
                                            <use xlink:href="#order-off"></use>
                                        </svg>
                                        <p class="md:text-xl">
                                            لیست سفارش های لغو شده خالی میباشد
                                        </p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

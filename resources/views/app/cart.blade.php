@extends('app.layouts.master')
@section('title', 'سبد خرید')
@section('content')
    <div class="container pb-14">
        <div class="grid grid-cols-12 gap-2 lg:gap-6">
            <!-- breadCrumb -->
            <div class="col-span-12 rounded-lg bg-muted">
                <ol class="grid grid-cols-2 overflow-hidden rounded-lg">
                    <li
                        class="flex flex-col items-center justify-center gap-2 bg-primary/10 p-4 text-xs text-primary /10 sm:text-sm md:text-base">
                        <svg class="h-6 w-6 md:h-8 md:w-8">
                            <use xlink:href="#cart" />
                        </svg>
                        <p class="leading-none">سبد خرید</p>
                    </li>
                    <li
                        class="flex flex-col items-center justify-center gap-2 p-4 text-xs text-primary opacity-50 sm:text-sm md:text-base">
                        <svg class="h-6 w-6 md:h-8 md:w-8">
                            <use xlink:href="#credit" />
                        </svg>

                        <p class="leading-none">پرداخت</p>
                    </li>
                </ol>
            </div>

            <!-- Cart List -->
            <div class="col-span-12 md:col-span-{{ $cart->items()->count() > 0 ? '8' : '12' }}">
                <div class="rounded-lg bg-muted p-4">
                    <!-- Heading -->
                    <div class="flex items-center justify-between gap-x-2 pb-4">
                        @if ($cart->items()->count() > 0)
                            <h1 class="flex items-center gap-x-4 text-sm xs:text-base md:text-lg">
                                سبد خرید
                                <span class="text-sm text-text/60"> ( {{ $cart->items()->count() }} کالا ) </span>
                            </h1>
                            <button type="button" class="btn-red-nobg px-3 py-2 text-sm">
                                <span>
                                    <svg class="h-6 w-6">
                                        <use xlink:href="#trash"></use>
                                    </svg>
                                </span>
                                <span>حذف همه</span>
                            </button>
                        @else
                            <h1 class="flex items-center gap-x-4 text-sm xs:text-base md:text-lg">
                                سبد خرید شما خالی است
                            </h1>
                        @endif
                    </div>
                    <ul class="divide-y">
                        <!-- Cart Item-->
                        @foreach ($cart->items as $item)
                            <li>
                                <div class="py-4 sm:py-6">
                                    <div
                                        class="grid grid-cols-2 items-center justify-start gap-2 xs:grid-cols-3 xs:gap-6 sm:grid-cols-4 xl:grid-cols-6">
                                        <!-- Image -->
                                        <div class="relative row-span-2 min-w-fit xs:mx-auto">
                                            <a href="{{ route('product', $item->product->slug) }}">
                                                <img alt="" class="w-25 rounded-lg sm:w-28"
                                                    src="{{ asset($item->product->image ?? 'assets/images/products/default-img.jpg') }}" />
                                            </a>

                                            <form action="{{ route('cart.remove', $item) }}" method="post">
                                                @csrf
                                                <button
                                                    class="absolute -right-2 -top-2 flex h-8 w-8 items-center justify-center rounded-full bg-background"
                                                    type="submit">
                                                    <svg class="h-6 w-6 text-red-600 dark:text-red-500">
                                                        <use xlink:href="#close" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <!-- Detail -->
                                        <div class="row-span-2 space-y-4 xs:col-span-2 sm:col-span-3 xl:col-span-5">
                                            <!-- Title -->
                                            <a class="line-clamp-2 text-sm xs:text-base"
                                                href="{{ route('product', $item->product->slug) }}">
                                                {{ $item->product->title }}
                                            </a>
                                            <!-- Book Writer -->
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs text-text/90 xs:text-sm">
                                                    نویسنده : {{ $item->product->writer->name }}</span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div
                                            class="flex justify-end gap-x-1 text-primary xs:col-span-2 sm:col-span-3 lg:text-lg xl:col-span-5">
                                            @if ($item->product->discounted_price)
                                                <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                    {{ number_format($item->product->price) }}
                                                </del>
                                                <span
                                                    class="font-bold">{{ number_format($item->product->discounted_price) }}</span>
                                                <span class="text-sm lg:text-base">تومان</span>
                                            @else
                                                <span class="font-bold">{{ number_format($item->product->price) }}</span>
                                                <span class="text-sm lg:text-base">تومان</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Cart Price Detail -->
            <div class="col-span-12 md:col-span-4">
                <!-- Desktop -->
                @if ($cart->items()->count() > 0)
                    <div class="hidden rounded-lg bg-muted p-4 md:block">
                        <div class="mb-2 divide-y">
                            <!-- cart items price before discount - coupon -->
                            <div class="flex items-center justify-between gap-x-2 py-6">
                                <div class="text-sm text-text/90 lg:text-base">
                                    قیمت کالا ها ({{ $cart->items()->count() }})
                                </div>

                                <div class="text-sm text-primary lg:text-base">
                                    <span class="font-bold">{{ number_format($productsTotalPrice) }}</span>
                                    <span class="text-xs lg:text-sm">تومان</span>
                                </div>
                            </div>

                            <!-- Discount -->
                            <div class="flex items-center justify-between gap-x-2 py-6">
                                <div class="text-sm text-text/90 lg:text-base">تخفیف</div>

                                <div class="text-sm font-medium text-red-500 dark:text-red-400 lg:text-base">
                                    <span class="font-bold">{{ number_format($productsTotalDiscount) }}</span>
                                    <span class="text-xs lg:text-sm">تومان</span>
                                </div>
                            </div>
                            <!-- Order final price -->

                            <div class="flex items-center justify-between gap-x-2 py-6">
                                <div class="text-sm text-text/90 lg:text-base">
                                    مبلغ قابل پرداخت
                                </div>

                                <div class="text-sm text-primary lg:text-base">
                                    <span class="font-bold">{{ number_format($cart->total_price) }}</span>
                                    <span class="text-xs lg:text-sm">تومان</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('checkout') }}" class="btn-primary py-3">
                                ادامه فرایند خرید
                            </a>
                        </div>
                    </div>
                    <!-- Mobile -->
                    <div class="fixed inset-x-0 bottom-0 flex items-center gap-x-6 rounded-t-2xl bg-muted p-4 md:hidden">
                        <a class="btn-primary flex-grow py-3" href="{{ route('checkout') }}">
                            ادامه فرایند خرید</a>
                        <div class="flex flex-col items-center gap-y-1">
                            <div class="text-sm text-text/60">مبلغ قابل پرداخت</div>
                            <div class="text-text/90">
                                <span class="font-bold">{{ number_format($cart->total_price) }}</span>
                                <span class="text-sm">تومان</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('app.layouts.master')
@section('title', 'پرداخت')
@section('content')
    <div class="container">
        <!-- breadCrumb -->
        <div class="col-span-12 mb-2 rounded-lg bg-muted lg:mb-6">
            <ol class="grid grid-cols-2 overflow-hidden rounded-lg">
                <li
                    class="flex flex-col items-center justify-center gap-2 p-4 text-xs text-primary opacity-50 sm:text-sm md:text-base">
                    <svg class="h-6 w-6 md:h-8 md:w-8">
                        <use xlink:href="#check" />
                    </svg>
                    <p class="leading-none">سبد خرید</p>
                </li>
                <li
                    class="flex flex-col items-center justify-center gap-2 bg-primary/10 p-4 text-xs text-primary /10 sm:text-sm md:text-base">
                    <svg class="h-6 w-6 md:h-8 md:w-8">
                        <use xlink:href="#credit" />
                    </svg>

                    <p class="leading-none">پرداخت</p>
                </li>
            </ol>
        </div>

        <div class="mx-auto max-w-[450px] rounded-lg bg-muted p-5">
            <!-- Head -->
            <h1 class="mb-8 text-center text-lg lg:text-xl">جزئیات سفارش</h1>

            <div class="mb-6">
                <!-- Coupon -->
                <div class="mb-4 flex items-center justify-between gap-x-2">
                    <div class="flex w-full items-center justify-between gap-x-2 rounded-lg border pl-4">
                        @if (!$cart->discount_status)
                            <form action="{{ route('checkout.apply-discount') }}" method="post"
                                class="flex justify-between w-full">
                                @csrf
                                <label for="coupon" class="relative block w-full rounded-lg shadow-base">
                                    <input type="text" id="coupon" name="code" value="{{ old('code') }}" required
                                        class="text-eft peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                        placeholder="کد تخفیف" />

                                    <span
                                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                        کد تخفیف
                                    </span>
                                </label>
                                <button type="submit" class="btn-primary-nobg py-2">اعمال</button>
                            </form>
                        @else
                            <div class="flex w-full items-center justify-between gap-x-2 rounded-lg">
                                <span class="text-sm mr-4 text-primary">مبلغ {{ $cart->total_off_price }} تومان از سفارش شما
                                    کسر شد</span>
                                <form action="{{ route('checkout.remove-discount') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn-primary-nobg py-2">
                                        <svg class="h-6 w-6 text-red-600 dark:text-red-500">
                                            <use xlink:href="#trash" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>



                <!-- Coupon -->
                @if ($cart->discount_status)
                    <div class="flex items-center justify-between gap-x-2 py-6">
                        <div class="text-sm text-text/90 lg:text-base">
                            کد اعمال شده
                        </div>

                        <div class="text-sm text-primary lg:text-base">
                            <span class="font-bold">{{ $cart->copan->code }}</span>
                        </div>
                    </div>
                @endif

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

                <div class="flex items-center justify-between gap-x-2 py-6">
                    <div class="text-sm text-text/90 lg:text-base">
                        درگاه پرداخت
                    </div>
                </div>
                <!-- Payment gateway -->

                <fieldset class="flex flex-wrap items-center justify-evenly gap-4 space-y-2">
                    <legend class="sr-only">Gateway</legend>
                    <!-- gateway item -->

                    <div>
                        <input type="radio" name="gateway" value="gateway-1" id="gateway-1" class="peer hidden" />

                        <label for="gateway-1"
                            class="relative block cursor-pointer rounded-lg border p-4 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                            <div class="flex items-center gap-x-4">
                                <img src="./assets/images/others/zarinpal.png" class="w-8 rounded-lg" alt="" />
                                <p class="text-text/90">زرین پال</p>
                            </div>
                        </label>
                    </div>

                    <div>
                        <input type="radio" name="gateway" value="gateway-2" id="gateway-2" class="peer hidden" />

                        <label for="gateway-2"
                            class="relative block cursor-pointer rounded-lg border p-4 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                            <div class="flex items-center gap-x-4">
                                <img src="./assets/images/others/saman.png" class="w-8 rounded-lg" alt="" />
                                <p class="text-text/90">بانک سامان</p>
                            </div>
                        </label>
                    </div>
                </fieldset>
            </div>
            <div>
                <form action="{{ route('checkout.submit') }}" method="post">
                    @csrf
                    <input type="hidden" name="gateway" value="gateway-1" />
                    <input type="hidden" name="total_price" value="{{ number_format($cart->total_price) }}" />
                    <button type="submit" class="btn-primary py-4 w-full"> پرداخت </button>
                </form>
            </div>
        </div>
    </div>
@endsection

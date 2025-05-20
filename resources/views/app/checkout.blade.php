@extends('app.layouts.master')
@section('title', 'پرداخت')
@section('content')
    <div class="container">
        <!-- breadCrumb -->
        <div class="col-span-12 mb-2 rounded-lg bg-muted lg:mb-6 mt-16">
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
                                <span class="text-sm mr-4 text-primary">مبلغ {{ number_format($cart->total_off_price) }}
                                    تومان از سفارش شما
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

                <form action="{{ route('checkout.submit') }}" method="post">
                    @csrf
                    <!-- Order final price -->
                    <div class="flex items-center justify-between gap-x-2 py-6">
                        <div class="text-sm text-text/90 lg:text-base">
                            مبلغ قابل پرداخت
                        </div>

                        <div class="text-sm text-primary lg:text-base">
                            <span
                                class="font-bold">{{ $cart->total_price > 0 ? number_format($cart->total_price) : 'رایگان' }}</span>
                            <span class="text-xs lg:text-sm">{{ $cart->total_price > 0 ? 'تومان' : '' }}</span>
                        </div>
                    </div>

                    @if ($cart->total_price > 0)
                        <!-- Payment type -->
                        <div class="flex items-center justify-between gap-x-2 py-6">
                            <div class="text-sm text-text/90 lg:text-base">
                                روش پرداخت
                            </div>
                        </div>

                        <fieldset class="flex flex-wrap items-center justify-evenly gap-4 space-y-2">
                            <legend class="sr-only">درگاه</legend>

                            <div>
                                <input type="radio" name="payment_type" value="0" id="wallet"
                                    class="peer hidden" />

                                <label for="wallet"
                                    class="relative block cursor-pointer rounded-lg border p-4 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                                    <div class="flex items-center gap-x-4">
                                        <p class="text-text/90">کیف پول</p>
                                        <svg class="h-6 w-6">
                                            <use xlink:href="#credit" />
                                        </svg>
                                    </div>
                                </label>
                            </div>

                            <div>
                                <input type="radio" name="payment_type" value="1" id="online"
                                    class="peer hidden" />

                                <label for="online"
                                    class="relative block cursor-pointer rounded-lg border p-4 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                                    <div class="flex items-center gap-x-4">
                                        <p class="text-text/90">پرداخت آنلاین</p>

                                    </div>
                                </label>
                            </div>

                        </fieldset>
                        <p class="text-red-500 dark:text-red-400 mb-2">
                            @error('payment_type')
                                {{ $message }}
                            @enderror
                        </p>
                        <p class="text-sm mt-2 text-gray-400">موجودی کیف پول {{ number_format($wallet->balance) }} تومان</p>

                        <div id="payment_gateways" class="hidden">
                            <div class="flex items-center justify-between gap-x-2 py-6">
                                <div class="text-sm text-text/90 lg:text-base">
                                    درگاه پرداخت
                                </div>
                            </div>
                            <!-- Payment gateway -->

                            <fieldset class="flex flex-wrap items-center justify-evenly gap-4 space-y-2">
                                <legend class="sr-only">درگاه</legend>
                                <!-- gateway item -->

                                <div>
                                    <input type="radio" name="payment_gateway" value="zarinPall" id="gateway-1"
                                        class="peer hidden" />

                                    <label for="gateway-1"
                                        class="relative block cursor-pointer rounded-lg border p-4 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                                        <div class="flex items-center gap-x-4">
                                            <img src="./assets/images/others/zarinpal.png" class="w-8 rounded-lg"
                                                alt="" />
                                            <p class="text-text/90">زرین پال</p>
                                        </div>
                                    </label>
                                </div>

                                <div>
                                    <input type="radio" name="payment_gateway" value="saman" id="gateway-2"
                                        class="peer hidden" />

                                    <label for="gateway-2"
                                        class="relative block cursor-pointer rounded-lg border p-4 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                                        <div class="flex items-center gap-x-4">
                                            <img src="./assets/images/others/saman.png" class="w-8 rounded-lg"
                                                alt="" />
                                            <p class="text-text/90">بانک سامان</p>
                                        </div>
                                    </label>
                                </div>
                            </fieldset>
                            <p class="text-red-500 dark:text-red-400">
                                @error('payment_gateway')
                                    {{$message}}
                                @enderror
                            </p>
                        </div>
                    @endif
                    <button type="submit" class="btn-primary py-4 w-full mt-6"> {{ $cart->total_price > 0 ? 'پرداخت' : 'نکمیل سفارش' }} </button>
                </form>
            </div>
            <div>
                <form action="{{ route('checkout.submit') }}" method="post">
                    @csrf
                    <input type="hidden" name="gateway" value="gateway-1" />
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentMethodRadios = document.querySelectorAll('input[name="payment_type"]');
            const paymentGatewaysSection = document.getElementById("payment_gateways");

            paymentMethodRadios.forEach(radio => {
                radio.addEventListener("change", function() {
                    if (this.value === "1") {
                        paymentGatewaysSection.style.display =
                            "block"; // نمایش بخش درگاه‌های پرداخت
                    } else {
                        paymentGatewaysSection.style.display =
                            "none"; // مخفی کردن بخش درگاه‌های پرداخت
                    }
                });
            });
        });
    </script>
@endsection

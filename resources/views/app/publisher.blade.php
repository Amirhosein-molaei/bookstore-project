@extends('app.layouts.master')
@section('title', $publisher->name)

@section('content')
    <!-- Color Effect -->
    <div class="fixed inset-x-0 top-1/3 mx-auto h-1/3 w-1/4 bg-primary/50 blur-[200px]"></div>
    <main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
        <section class="mb-8 w-full h-32">
            <div class="flex items-center justify-center p-8">
                <h2 class="h-2" style="font-size: 30px">{{ $publisher->name }}</h2>
            </div>
        </section>


        <!-- hot deals(textual) Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">
                        داغ ترین های متنی
                    </h3>
                    <a class="flex items-center gap-x-2 py-2 text-sm text-primary lg:text-base" href="./shop.html">
                        مشاهده همه
                        <span>
                            <svg class="h-5 w-5 lg:h-6 lg:w-6">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- Section Content -->

                <div class="swiper product-slider p-px">
                    <div class="swiper-wrapper">
                        @foreach ($textualHotDeals as $hotDeal)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $hotDeal) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($hotDeal->image) }}" style="height: 260px;"/>
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($hotDeal->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$mostViewProduct->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $hotDeal) }}">
                                                {{ $hotDeal->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($hotDeal->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ $hotDeal->price }}
                                                    </del>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between">
                                                @if ($hotDeal->discounted_price)
                                                    <div>
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $hotDeal->discount_percentage }}%
                                                        </p>
                                                    </div>
                                                @endif
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $hotDeal->discounted_price ? $hotDeal->discounted_price : $hotDeal->price }}
                                                    <span class="text-xs font-light md:text-sm">تومان</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
        <!-- hot deals(textual) Products section End -->

        <!-- hot deals(audio) Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">
                        داغ ترین های صوتی
                    </h3>
                    <a class="flex items-center gap-x-2 py-2 text-sm text-primary lg:text-base" href="{{ route('shop') }}">
                        مشاهده همه
                        <span>
                            <svg class="h-5 w-5 lg:h-6 lg:w-6">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- Section Content -->

                <div class="swiper product-slider p-px">
                    <div class="swiper-wrapper">
                        @foreach ($audioHotDeals as $hotDeal)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $hotDeal) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($hotDeal->image) }}" style="height: 260px;"/>
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($hotDeal->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$mostViewProduct->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $hotDeal) }}">
                                                {{ $hotDeal->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($hotDeal->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ $hotDeal->price }}
                                                    </del>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between">
                                                @if ($hotDeal->discounted_price)
                                                    <div>
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $hotDeal->discount_percentage }}%
                                                        </p>
                                                    </div>
                                                @endif
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $hotDeal->discounted_price ? $hotDeal->discounted_price : $hotDeal->price }}
                                                    <span class="text-xs font-light md:text-sm">تومان</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
        <!-- hot deals(audio) Products section End -->


        <!-- most saled Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">
                        پرفروش ترین محصولات
                    </h3>
                    <a class="flex items-center gap-x-2 py-2 text-sm text-primary lg:text-base"
                        href="{{ route('shop') }}">
                        مشاهده همه
                        <span>
                            <svg class="h-5 w-5 lg:h-6 lg:w-6">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- Section Content -->


                <div class="swiper product-slider p-px">


                    <div class="swiper-wrapper">
                        @foreach ($mostSelledProducts as $mostSelledProduct)
                        <div class="swiper-slide">
                            <div
                                class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                <!-- Product Card -->
                                <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                    <!-- image -->
                                    <div class="mb-2 md:mb-5" draggable="false">
                                        <a href="{{ route('product', $mostSelledProduct) }}">
                                            <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                src="{{ asset($mostSelledProduct->image) }}" style="height: 260px;"/>
                                        </a>
                                    </div>
                                    <!-- rate -->
                                    @if ($mostSelledProduct->rate > 0)
                                        <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                            <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                <span class="star text-white">★</span>{{$mostSelledProduct->rate}}
                                            </p>
                                        </div>
                                    @endif
                                    <!-- title -->
                                    <div class="mb-2">
                                        <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                            href="{{ route('product', $mostSelledProduct) }}">
                                            {{ $mostSelledProduct->title }}
                                        </a>
                                    </div>
                                    <!-- Prices -->
                                    <div class="flex flex-col">
                                        <!-- Old price -->
                                        @if ($mostSelledProduct->discounted_price)
                                            <div class="h-5 text-left">
                                                <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                    {{ $mostSelledProduct->price }}
                                                </del>
                                            </div>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            @if ($mostSelledProduct->discounted_price)
                                                <div>
                                                    <p
                                                        class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                        {{ $mostSelledProduct->discount_percentage }}%
                                                    </p>
                                                </div>
                                            @endif
                                            <!-- New price -->
                                            <div class="text-sm font-bold text-primary md:text-base">
                                                {{ $mostSelledProduct->discounted_price ? $mostSelledProduct->discounted_price : $mostSelledProduct->price }}
                                                <span class="text-xs font-light md:text-sm">تومان</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            </div>
        </section>
        <!-- most saled Products section End -->

        <!-- new Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">
                        جدید ترین محصولات
                    </h3>
                    <a class="flex items-center gap-x-2 py-2 text-sm text-primary lg:text-base"
                        href="{{ route('shop') }}">
                        مشاهده همه
                        <span>
                            <svg class="h-5 w-5 lg:h-6 lg:w-6">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- Section Content -->


                <div class="swiper product-slider p-px">


                    <div class="swiper-wrapper">
                        @foreach ($newProducts as $newProduct)
                        <div class="swiper-slide">
                            <div
                                class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                <!-- Product Card -->
                                <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                    <!-- image -->
                                    <div class="mb-2 md:mb-5" draggable="false">
                                        <a href="{{ route('product', $newProduct) }}">
                                            <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                src="{{ asset($newProduct->image) }}" style="height: 260px;"/>
                                        </a>
                                    </div>
                                    <!-- rate -->
                                    @if ($newProduct->rate > 0)
                                        <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                            <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                <span class="star text-white">★</span>{{$newProduct->rate}}
                                            </p>
                                        </div>
                                    @endif
                                    <!-- title -->
                                    <div class="mb-2">
                                        <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                            href="{{ route('product', $newProduct) }}">
                                            {{ $newProduct->title }}
                                        </a>
                                    </div>
                                    <!-- Prices -->
                                    <div class="flex flex-col">
                                        <!-- Old price -->
                                        @if ($newProduct->discounted_price)
                                            <div class="h-5 text-left">
                                                <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                    {{ $newProduct->price }}
                                                </del>
                                            </div>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            @if ($newProduct->discounted_price)
                                                <div>
                                                    <p
                                                        class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                        {{ $newProduct->discount_percentage }}%
                                                    </p>
                                                </div>
                                            @endif
                                            <!-- New price -->
                                            <div class="text-sm font-bold text-primary md:text-base">
                                                {{ $newProduct->discounted_price ? $newProduct->discounted_price : $newProduct->price }}
                                                <span class="text-xs font-light md:text-sm">تومان</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            </div>
        </section>
        <!-- new Products section End -->

    @endsection

@extends('app.layouts.master')
@use('Morilog\Jalali\Jalalian')
@section('title', 'صفحه اصلی')

@section('content')
    <!-- Color Effect -->
    <div class="fixed inset-x-0 top-1/3 mx-auto h-1/3 w-1/4 bg-primary/50 blur-[200px]"></div>
        <!-- Main Banners section Start -->
        <section class="mb-8">
            <div class="container relative grid grid-cols-12 gap-x-4 gap-y-2">
                <div class="col-span-12 lg:col-span-8">
                    <!-- Swiper -->
                    <div class="swiper banner-slider rounded-lg shadow-base">
                        <div class="swiper-wrapper">
                            @foreach ($sliders->where('position', 1) as $slider)
                                <div class="swiper-slide">
                                    <a href="{{ url($slider->url) }}">
                                        <img alt="" class="max-h-[450px]" src="{{ asset($slider->image) }}"
                                            style="width: 100%" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next hidden md:flex"></div>
                        <div class="swiper-button-prev hidden md:flex"></div>
                        <div class="swiper-pagination main-banner-pagination"></div>
                    </div>
                </div>
                <div class="col-span-12 hidden xs:block lg:col-span-4">
                    <div class="flex h-full flex-row justify-between gap-x-2 lg:flex-col">
                        @foreach ($sliders->where('position', 2) as $slider)
                            <div>
                                <a href="{{ url($slider->url) }}">
                                    <img alt="" class="rounded-lg shadow-base" src="{{ asset($slider->image) }}" />
                                </a>
                            </div>
                        @endforeach
                        @foreach ($sliders->where('position', 3) as $slider)
                            <div>
                                <a href="{{ url($slider->url) }}">
                                    <img alt="" class="rounded-lg shadow-base" src="{{ asset($slider->image) }}" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- latest Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">جدیدترین ها</h3>
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
                        @foreach ($latestProducts as $product)
                            <div class="swiper-slide">
                                <!-- Product Card -->
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($product->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px" />
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($product->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$product->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $product->slug) }}">
                                                {{ $product->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($product->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ number_format($product->price) }}
                                                    </del>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between">
                                                @if ($product->discounted_price)
                                                    <div>
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $product->discount_percentage }}%
                                                        </p>
                                                    </div>
                                                @endif
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $product->discounted_price ? number_format($product->discounted_price) : number_format($product->price) }}
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
        <!-- suggested Products section End -->

        <!-- suggested Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">پیشنهادات کاربران</h3>
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
                        @foreach ($suggesteds as $suggested)
                            <div class="swiper-slide">
                                <!-- Product Card -->
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $suggested->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($suggested->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px" />
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($suggested->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$suggested->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $suggested->slug) }}">
                                                {{ $suggested->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($suggested->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ number_format($suggested->price) }}
                                                    </del>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between">
                                                @if ($suggested->discounted_price)
                                                    <div>
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $suggested->discount_percentage }}%
                                                        </p>
                                                    </div>
                                                @endif
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $suggested->discounted_price ? number_format($suggested->discounted_price) : number_format($suggested->price) }}
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
        <!-- suggested Products section End -->

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
                        @foreach ($hotDeals->where('type', 0) as $hotDeal)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $hotDeal->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($hotDeal->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px"/>
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($hotDeal->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$hotDeal->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $hotDeal->slug) }}">
                                                {{ $hotDeal->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($hotDeal->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ number_format($hotDeal->price) }}
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
                                                    {{ $hotDeal->discounted_price ? number_format($hotDeal->discounted_price) : number_format($hotDeal->price) }}
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
                        @foreach ($hotDeals->where('type', 1) as $hotDeal)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $hotDeal->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($hotDeal->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px"/>
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($hotDeal->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$hotDeal->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $hotDeal->slug) }}">
                                                {{ $hotDeal->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($hotDeal->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ number_format($hotDeal->price) }}
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
                                                    {{ $hotDeal->discounted_price ? number_format($hotDeal->discounted_price) : number_format($hotDeal->price) }}
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

        <!-- Category Banners section Start -->
        <section class="mb-8">
            <div class="container relative">
                <div class="flex w-full flex-col justify-between gap-4 md:flex-row">
                    @foreach ($banners as $banner)
                        <a href="#">
                            <img alt="" class="rounded-base" src="{{ asset($banner->image) }}" />
                        </a>
                    @endforeach
                </div>
            </div>
        </section>


        <!-- Special Products section Start -->
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
                        @foreach ($mosteSelledProducts as $mosteSelledProduct)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $mosteSelledProduct->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($mosteSelledProduct->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px"/>
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($mosteSelledProduct->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$mosteSelledProduct->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $mosteSelledProduct->slug) }}">
                                                {{ $mosteSelledProduct->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($mosteSelledProduct->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ number_format($mosteSelledProduct->price) }}
                                                    </del>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between">
                                                @if ($mosteSelledProduct->discounted_price)
                                                    <div>
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $mosteSelledProduct->discount_percentage }}%
                                                        </p>
                                                    </div>
                                                @endif
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $mosteSelledProduct->discounted_price ? number_format($mosteSelledProduct->discounted_price) : number_format($mosteSelledProduct->price) }}
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

        <!-- most viewd Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">
                        پربازدید ترین محصولات
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
                        @foreach ($mostViewProducts as $mostViewProduct)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $mostViewProduct->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($mostViewProduct->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px"/>
                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($mostViewProduct->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{$mostViewProduct->rate}}
                                                </p>
                                            </div>
                                        @endif
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $mostViewProduct->slug) }}">
                                                {{ $mostViewProduct->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            @if ($mostViewProduct->discounted_price)
                                                <div class="h-5 text-left">
                                                    <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                        {{ number_format($mostViewProduct->price) }}
                                                    </del>
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between">
                                                @if ($mostViewProduct->discounted_price)
                                                    <div>
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $mostViewProduct->discount_percentage }}%
                                                        </p>
                                                    </div>
                                                @endif
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $mostViewProduct->discounted_price ? number_format($mostViewProduct->discounted_price) : number_format($mostViewProduct->price) }}
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
        <!-- Newest Products section End -->

        <!-- Blog section Start -->
        <section class="mb-6">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">مطالب خواندنی</h3>
                    <a class="flex items-center gap-x-2 py-2 text-sm text-primary lg:text-base" href="./blog.html">
                        مشاهده همه
                        <span>
                            <svg class="h-5 w-5 lg:h-6 lg:w-6">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </span>
                    </a>
                </div>
                <!-- Section Content -->
                <div class="swiper blog-slider p-px">
                    <div class="swiper-wrapper">
                        @foreach ($latestBlogs as $blog)
                          <div class="swiper-slide">
                            <div
                                class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                <!-- Blog Card -->
                                <div>
                                    <a href="{{ route('blogs.show', $blog) }}">
                                        <div class="relative rounded-xl bg-muted p-2 shadow-base">
                                            <!-- image -->
                                            <div class="mb-2 md:mb-5" draggable="false">
                                                <img alt="blog" class="mx-auto w-100 rounded-lg rounded-bl-3xl"
                                                    src="{{ asset($blog->image) }}" style="height: 130px" />
                                            </div>
                                            <!-- title -->
                                            <div class="mb-2">
                                                <p class="line-clamp-2 h-10 text-sm md:h-12 md:text-base">
                                                    {{ $blog->title }}
                                                </p>
                                            </div>
                                            <div class="flex justify-end">
                                                <p class="text-xs text-primary xs:text-sm">
                                                    {{ Jalalian::forge($blog->created_at)->format('%B %d، %Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
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

        <!-- Blog section End -->
    @endsection

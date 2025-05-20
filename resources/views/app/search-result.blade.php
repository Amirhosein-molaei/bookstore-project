@extends('app.layouts.master')
@use('Morilog\Jalali\Jalalian')
@section('title', content: 'نتیجه جست و جو')

@section('content')
    <!-- Color Effect -->
    <div class="fixed inset-x-0 top-1/3 mx-auto h-1/3 w-1/4 bg-primary/50 blur-[200px]"></div>
    <section class="mb-8 w-full h-32">
        <div class="flex items-center justify-center p-8">
            <h2 class="h-2" style="font-size: 30px">نتیجه جست و جو برای :{{ $search }}</h2>
        </div>
    </section>


    @if ($matchProducts->count() > 0)
        <!-- textual Products section Start -->
        <section class="mb-8">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">
                        محصولات
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
                        @foreach ($matchProducts as $product)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($product->image ?? 'assets/images/products/default-img.jpg') }}" style="height: 260px;"/>

                                            </a>
                                        </div>
                                        <!-- rate -->
                                        @if ($product->rate > 0)
                                            <div class="absolute right-0 top-0 mt-2 mb-2 mr-2">
                                                <p
                                                    class="w-12 rounded-full btn-yellow py-px text-center text-sm text-white">
                                                    <span class="star text-white">★</span>{{ $product->rate }}
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
        <!-- textual Products section End -->
    @endif

    @if ($matchBlogs->count() > 0)
        <!-- Blog section Start -->
        <section class="mb-6">
            <div class="container relative">
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">مطالب خواندنی</h3>
                    <a class="flex items-center gap-x-2 py-2 text-sm text-primary lg:text-base" href="{{ route('blogs.index') }}">
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
                        @foreach ($matchBlogs as $blog)
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
    @endif


@endsection

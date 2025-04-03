@extends('app.layouts.master')
@php
    use Morilog\Jalali\Jalalian;
@endphp
@section('title', $product->title)
@section('content')
    <div class="container">
        <!-- Desktop Product Detail -->
        <div class="hidden lg:block">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav aria-label="Breadcrumb" class="w-fit rounded-lg bg-muted px-4 py-4 shadow-base">
                    <ol class="flex flex-wrap items-center justify-center gap-x-2 gap-y-4">
                        <li class="flex items-center gap-x-2">
                            <a href="{{ route('app.home') }}" class="text-sm text-text/90 hover: hover:">
                                {{ $setting->title }}
                            </a>
                            <span class="text-text/90">
                                <svg class="h-5 w-5">
                                    <use xlink:href="#chevron-left" />
                                </svg>
                            </span>
                        </li>
                        <li class="flex items-center gap-x-2">
                            <a href="#" class="text-sm text-text/90 hover: hover:">
                                {{ $product->category->parent ? $product->category->parent->name : $product->category->name }}
                            </a>
                            <span class="text-text/90">
                                <svg class="h-5 w-5">
                                    <use xlink:href="#chevron-left" />
                                </svg>
                            </span>
                        </li>

                        <li>
                            <a href="#" class="text-sm text-text/90 hover: hover:">
                                {{ $product->category->parent ? $product->category->name : '' }}
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- Product Detail Section -->
            <div class="mb-6 rounded-lg bg-muted p-6 shadow-base">
                <div class="mb-6 grid flex-grow grid-cols-12 gap-4">
                    <div class="col-span-4">
                        <div class="min-w-fit space-y-2">
                            <!-- Product other actions -->
                            <div class="py-2">
                                <div class="flex items-center gap-x-4">
                                    <!-- add to favorite -->
                                    @if (Auth::check())
                                        <div>
                                            <form style="margin-bottom: 0"
                                                action="{{ route('product.favorite', $product) }}" method="post">
                                                @csrf
                                                <button data-tooltip-target="add-to-favorite" type="submit">
                                                    @if ($product->isFavorited())
                                                        <svg class="h-6 w-6 text-primary">
                                                            <use xlink:href="#heart" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-6 w-6">
                                                            <use xlink:href="#heart" />
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>
                                            <div id="add-to-favorite" role="tooltip"
                                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-zinc-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-zinc-800">
                                                افزودن به علاقه‌مندی ها
                                            </div>
                                        </div>
                                    @endif

                                    <!-- share on social -->
                                    <div>
                                        <button id="dropdownMenuCopySocialShareLink"
                                            data-dropdown-toggle="copy-social-share-link"
                                            data-tooltip-target="share-on-social" type="button">
                                            <svg class="h-6 w-6">
                                                <use xlink:href="#social-share" />
                                            </svg>
                                        </button>
                                        <div id="share-on-social" role="tooltip"
                                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-zinc-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-zinc-800">
                                            اشتراک گذاری
                                        </div>
                                        <!-- Dropdown menu -->
                                        <div class="z-10 !ml-5 hidden w-50 overflow-hidden rounded-lg border bg-muted shadow-base"
                                            id="copy-social-share-link">
                                            <ul class="space-y-2 p-2">
                                                <li>
                                                    <button type="button" data-link="{{ route('product', $product) }}"
                                                        onclick="copyToClipboardSocialShareDesktop(this)"
                                                        class="flex w-full items-center justify-between rounded-lg px-4 py-3 text-sky-500 hover:bg-sky-500/10 dark:text-sky-400 dark:hover:bg-sky-400/10">
                                                        <div class="flex items-center gap-x-2">
                                                            <svg class="h-6 w-6">
                                                                <use xlink:href="#copy"></use>
                                                            </svg>
                                                            <span id="copyToClipboardSocialShareText">
                                                                کپی کردن لینک
                                                            </span>
                                                        </div>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Main image -->
                            <div>
                                <img src="{{ asset($product->image) }}" alt="" class="mx-auto" loading="lazy" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-8 flex min-h-full flex-col">
                        <div class="mb-2 flex items-center gap-x-1 text-primary">
                            <a href="#"> {{ $product->category->name }} </a>
                            <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </div>
                        <!-- Main Title ( persian ) -->
                        <h1 class="mb-4 text-lg font-semibold">
                            {{ $product->title }}
                        </h1>

                        <div class="grid flex-grow grid-cols-2 gap-x-4">
                            <!-- right side -->
                            <div class="col-span-1">
                                <!-- comments & SKU -->
                                <div class="mb-4 flex items-center gap-x-4 text-sm font-light text-primary">
                                    @if ($product->comments->count() > 0)
                                        <div>
                                            <a href="#"> امتیاز
                                                {{ round($product->Comments->where('parent_id', null)->sum('rate') / $product->comments->where('parent_id', null)->count(), 1) }} از 5</a>
                                        </div>
                                    @endif
                                    <span class="h-4 w-px rounded-full bg-background dark:bg-muted/10"></span>
                                    <div>
                                        <a href="#"> {{ $commentCount }} دیدگاه </a>
                                    </div>
                                </div>
                                <!-- users suggestion -->
                                <div class="mb-4 flex gap-x-2">
                                    <svg class="h-4 w-4 text-primary">
                                        <use xlink:href="#like" />
                                    </svg>
                                    <p class="text-sm font-light text-text/60">
                                        80% از خریداران، خرید این کالا را پیشنهاد کرده‌اند
                                    </p>
                                </div>

                                <!-- Property -->
                                <div>
                                    <p class="mb-6 font-medium">ویژگی های محصول</p>

                                    <ul class="space-y-4">
                                        <li class="flex gap-x-2">
                                            <div class="min-w-fit text-text/60">نوع :</div>
                                            <div class="text-text/90">
                                                @if ($product->type == 0)
                                                    متنی
                                                @else
                                                    صوتی
                                                @endif
                                            </div>
                                        </li>
                                        <li class="flex gap-x-2">
                                            <div class="min-w-fit text-text/60">نویسنده :</div>
                                            <div class="text-text/90">{{ $product->writer->name }}</div>
                                        </li>
                                        <li class="flex gap-x-2">
                                            <div class="min-w-fit text-text/60">
                                                انتشارات:
                                            </div>
                                            <div class="text-text/90">{{ $product->publisher->name }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- left side -->
                            <div class="col-span-1 flex flex-col">
                                <div class="flex-grow">
                                    <!-- variant -->
                                    <div class="mb-6 space-y-6">
                                        <!-- Color -->
                                        <div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <!-- verified text -->
                                    {{-- <div
                                        class="mb-6 flex items-center gap-x-2 rounded-lg bg-primary/10 p-4 text-sm text-primary /5">
                                        <svg class="h-6 w-6">
                                            <use xlink:href="#verified" />
                                        </svg>
                                        تضمین سلامت فیزیکی و اصالت کالا
                                    </div> --}}
                                    <!-- price -->
                                    <div class="mb-6 flex items-center justify-end gap-x-1 text-primary">
                                        <span class="text-xl font-bold">
                                            {{ $product->discounted_price ? number_format($product->discounted_price) : $product->price }}
                                        </span>
                                        <span>تومان</span>
                                    </div>
                                    <!-- add to cart -->
                                    <div class="mb-6">
                                        @if ($cart->hasProduct($product->id))
                                            <form
                                                action="{{ route('cart.remove', $product->cartItems->where('product_id', $product->id)->first()) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn-red w-full py-3">
                                                    حذف از سبد خرید
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('cart.add', $product) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn-primary w-full py-3">
                                                    افزودن به سبد خرید
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Product Detail-->
        <div class="lg:hidden">
            <!-- breadcrumb -->
            <div class="mb-4 flex flex-wrap items-center gap-2">
                <div class="flex items-center gap-x-1 text-sm font-light text-primary sm:text-base md:text-base">
                    <a href="{{ route('app.home') }}"> {{ $setting->title }} </a>
                    <svg class="h-5 w-5">
                        <use xlink:href="#chevron-left" />
                    </svg>
                </div>
                <div class="flex items-center gap-x-1 text-sm font-light text-primary sm:text-base md:text-base">
                    <a href="./index.html">
                        {{ $product->category->parent ? $product->category->parent->name : $product->category->name }} </a>
                    <svg class="h-5 w-5">
                        <use xlink:href="#chevron-left" />
                    </svg>
                </div>
                <div class="line-clamp-1 text-sm font-light text-primary sm:text-base md:text-base">
                    <a href="#">{{ $product->category->parent ? $product->category->name : '' }}</a>
                </div>
            </div>
            <!-- Product Detail Section -->
            <div class="mb-6 rounded-lg bg-muted p-4 shadow-base">
                <!-- Product Gallery -->
                <div class="relative mb-4">
                    <div class="swiper product-image-mobile-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset($product->image) }}" alt="" class="mx-auto"
                                    loading="lazy" />
                            </div>
                        </div>
                    </div>
                    <div class="absolute left-0 top-0 z-10">
                        <div class="flex items-center gap-x-4">
                            <!-- add to favorite -->
                            @if (Auth::check())
                                <div>
                                    <form style="margin-bottom: 0" action="{{ route('product.favorite', $product) }}"
                                        method="post">
                                        @csrf
                                        <button data-tooltip-target="add-to-favorite" type="submit">
                                            @if ($product->isFavorited())
                                                <svg class="h-6 w-6 text-primary">
                                                    <use xlink:href="#heart" />
                                                </svg>
                                            @else
                                                <svg class="h-6 w-6">
                                                    <use xlink:href="#heart" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <!-- share on social -->
                            <div class="relative">
                                <button type="button" onclick="copyToClipboardSocialShareMobile(this)"
                                    data-link="{{ route('product', $product) }}">
                                    <svg class="h-6 w-6">
                                        <use xlink:href="#social-share" />
                                    </svg>
                                </button>
                                <div id="notify-copied-social-share-link-mobile"
                                    class="absolute left-0 top-full z-10 hidden w-24 rounded-lg bg-zinc-900 px-3 py-2 text-center text-sm font-medium text-white shadow-sm transition-opacity duration-300 dark:bg-zinc-800">
                                    کپی شد !
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
                <div class="mb-4 flex flex-wrap items-center gap-2">
                    <div class="flex items-center gap-x-1 text-sm font-light text-primary md:text-base">
                        <a
                            href="#">{{ $product->category->parent ? $product->category->parent->name : $product->category->name }}</a>
                        <svg class="h-5 w-5">
                            <use xlink:href="#chevron-left" />
                        </svg>
                    </div>
                    <div class="line-clamp-1 text-sm font-light text-primary md:text-base">
                        <a href="#"> {{ $product->category->parent ? $product->category->name : '' }} </a>
                    </div>
                </div>
                <!-- title -->
                <div class="mb-4 font-semibold md:text-lg">
                    {{ $product->title }}
                </div>
                <!-- comments & SKU -->
                <div class="flex gap-x-4 text-sm font-light text-primary md:text-base">
                    @if ($product->comments->count() > 0)
                        <div>
                            <a href="#"> امتیاز
                                {{ round($product->Comments->where('parent_id', null)->sum('rate') / $product->comments->where('parent_id', null)->count(), 1) }} از 5</a>
                        </div>
                    @endif
                    <div>
                        <a href="#"> {{ $commentCount }} دیدگاه </a>
                    </div>
                </div>
                <div class="my-4 h-px w-full bg-background"></div>
                <!-- Property -->
                <div class="mb-6 rounded-lg bg-muted p-4 shadow-base lg:hidden">
                    <p class="mb-6">اطلاعات محصول</p>

                    <ul class="space-y-4">
                        <li class="flex gap-x-2">
                            <div class="min-w-fit text-sm text-text/60">نوع :</div>
                            <div class="text-sm text-text/90">
                                @if ($product->type == 0)
                                    متنی
                                @else
                                    صوتی
                                @endif
                            </div>
                        </li>
                        <li class="flex gap-x-2">
                            <div class="min-w-fit text-sm text-text/60">نویسنده :</div>
                            <div class="text-sm text-text/90">
                                {{ $product->writer->name }}
                            </div>
                        </li>
                        <li class="flex gap-x-2">
                            <div class="min-w-fit text-sm text-text/60">
                                انتشارات :
                            </div>
                            <div class="text-sm text-text/90">
                                {{ $product->publisher->name }}
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Add to Cart -->
                <div class="fixed inset-x-0 bottom-0 z-10 bg-muted p-5">
                    <div class="flex items-center justify-between gap-x-6">
                        <!-- Button -->
                        <div class="flex grow">
                            <button class="btn-primary w-full px-4 py-3 text-sm">
                                افزودن به سبد خرید
                            </button>
                        </div>
                        <!-- Price -->
                        <div class="space-y-1">
                            <!-- Old Price -->
                            @if ($product->discounted_price)
                                <div class="flex items-center gap-x-2">
                                    <div>
                                        <del class="text-sm text-text/60 decoration-warning md:text-base">
                                            {{ number_format($product->price) }}
                                        </del>
                                    </div>
                                    <div
                                        class="flex w-10 items-center justify-center rounded-full bg-warning py-0.5 text-sm font-bold text-white dark:bg-red-600">
                                        {{ $product->discount_percentage }}%
                                    </div>
                                </div>
                            @endif
                            <!-- New Price -->
                            <div class="text-primary">
                                <span
                                    class="font-semibold">{{ $product->discounted_price ? $product->discounted_price : $product->price }}</span>
                                <span class="text-sm font-light">تومان</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mb-6">
            <div>
                <!-- Section Header -->
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-medium md:text-lg lg:text-xl">کالاهای مرتبط</h3>
                </div>
                <!-- Section Content -->
                <div class="swiper product-slider p-px">
                    <div class="swiper-wrapper">

                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="swiper-slide">
                                <div
                                    class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                    <!-- Product Card -->
                                    <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                        <!-- image -->
                                        <div class="mb-2 md:mb-5" draggable="false">
                                            <a href="{{ route('product', $relatedProduct) }}">
                                                <img alt="{{ $relatedProduct->title }}"
                                                    class="mx-auto w-32 rounded-lg md:w-auto"
                                                    src="{{ asset($relatedProduct->image) }}" />
                                            </a>
                                        </div>
                                        <!-- title -->
                                        <div class="mb-2">
                                            <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                                href="{{ route('product', $relatedProduct) }}">
                                                {{ $relatedProduct->title }}
                                            </a>
                                        </div>
                                        <!-- Prices -->
                                        <div class="flex flex-col">
                                            <!-- Old price -->
                                            <div class="h-5 text-left">
                                                <del class="text-sm text-text/60 decoration-warning md:text-base">
                                                    {{ $relatedProduct->discounted_price ? number_format($relatedProduct->price) : '' }}
                                                </del>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    @if ($relatedProduct->discount_percentage)
                                                        <p
                                                            class="w-9 rounded-full bg-warning py-px text-center text-sm text-white">
                                                            {{ $relatedProduct->discount_percentage }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <!-- New price -->
                                                <div class="text-sm font-bold text-primary md:text-base">
                                                    {{ $relatedProduct->discounted_price ? number_format($relatedProduct->discounted_price) : number_format($relatedProduct->price) }}
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
        </div>
        <!-- description / specs / commment  -->
        <div class="rounded-lg bg-muted p-4 shadow-base">
            <div class="mb-6">
                <ul
                    class="-mb-px flex justify-between gap-x-2 border-b text-center text-sm font-medium xs:justify-start xs:gap-x-4 xs:text-base">
                    <li>
                        <a href="#description"
                            class="inline-block rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover: text-text/90 dark:hover:text-zinc-300">
                            معرفی
                        </a>
                    </li>
                    <li>
                        <a href="#specs"
                            class="inline-block rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover: text-text/90 dark:hover:text-zinc-300">
                            مشخصات
                        </a>
                    </li>
                    <li>
                        <a href="#comments"
                            class="relative inline-block rounded-t-lg border-b-2 border-transparent px-2 pb-2 hover: text-text/90 dark:hover:text-zinc-300">
                            دیدگاه ها
                            <span
                                class="absolute -left-5 -top-4 flex h-7 w-7 items-center justify-center rounded-full bg-primary text-xs text-white dark:bg-emerald-600 xs:text-sm">
                                {{ $commentCount }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="space-y-16 divide-y">
                <div class="py-6" id="description">
                    <div class="relative mb-16 w-fit text-xl font-medium">
                        معرفی
                        <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                        </span>
                    </div>
                    <div class="mb-6 max-h-[500px] overflow-hidden md:mb-10" id="descriptionContainer">
                        <div class="space-y-4 text-sm leading-loose text-text/90 lg:text-base">

                            <p>
                                {!! $product->description !!}
                            </p>
                            <div class="flex justify-center">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" />
                            </div>

                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button class="btn-secondary-nobg hidden md:flex" id="toggleDescriptionButton">
                            مشاهده بیشتر
                            <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </button>
                        <button id="descriptionButtonMobile" aria-controls="mobile-description-drawer-navigation"
                            data-drawer-show="mobile-description-drawer-navigation" data-drawer-placement="bottom"
                            data-drawer-target="mobile-description-drawer-navigation" type="button"
                            class="btn-secondary-nobg md:hidden">
                            مشاهده بیشتر
                            <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="py-6" id="specs">
                    <div class="relative mb-16 w-fit text-xl font-medium">
                        مشخصات
                        <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                        </span>
                    </div>
                    <div class="mb-6 max-h-[500px] overflow-hidden md:mb-10" id="specsContainer">
                        <ul class="space-y-6 text-sm">
                            <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                <div class="col-span-1 text-text/60"> نوع کتاب :</div>
                                <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                    <ul class="space-y-4">
                                        <li>
                                            @if ($product->type == 0)
                                                متنی
                                            @else
                                                صوتی
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @if ($product->type == 0)
                                <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                    <div class="col-span-1 text-text/60">تعداد صفحات : </div>
                                    <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                        <ul class="space-y-4">
                                            <li>{{ $product->page_count }}</li>
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                <div class="col-span-1 text-text/60">
                                    سال انتشار :
                                </div>
                                <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                    <ul class="space-y-4">
                                        <li>{{ $product->release_year }}</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                <div class="col-span-1 text-text/60">
                                    نویسنده :
                                </div>
                                <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                    <ul class="space-y-4">
                                        <li>{{ $product->writer->name }}</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                <div class="col-span-1 text-text/60">
                                    انتشارات :
                                </div>
                                <div class="col-span-2 border-b pb-4 text-text/90 lg:col-span-4">
                                    <ul class="space-y-4">
                                        <li>{{ $product->publisher->name }}</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="grid grid-cols-3 gap-x-2 lg:grid-cols-5">
                                <div class="col-span-1 text-text/60"> فایل های محصول</div>
                                <div class="col-span-2 pb-4 text-text/90 lg:col-span-4">
                                    <ul class="space-y-4">
                                        @foreach ($productFiles as $productFile)
                                            <li> {{ $productFile->name }}</li>
                                        @endforeach


                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="flex justify-center">
                        <button class="btn-secondary-nobg hidden md:flex" id="toggleSpecsButton">
                            مشاهده بیشتر
                            <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </button>
                        <button id="specsButtonMobile" class="btn-secondary-nobg md:hidden"
                            aria-controls="mobile-spec-drawer-navigation" data-drawer-show="mobile-spec-drawer-navigation"
                            data-drawer-placement="bottom" data-drawer-target="mobile-spec-drawer-navigation"
                            type="button">
                            مشاهده بیشتر
                            <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="py-6" id="comments">
                    <div class="relative mb-16 w-fit text-xl font-medium">
                        دیدگاه ها
                        <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                        </span>
                    </div>

                    <div>

                        <div class="grid grid-cols-12 gap-y-8 md:gap-8">
                            <!-- Submit New Comment -->
                            @if (Auth::check())
                                <div class="col-span-12 md:col-span-4 lg:col-span-3">
                                    <form action="{{ route('product.comment', $product) }}" method="post">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-4 md:sticky md:top-32">

                                            <div class="text-lg">ثبت دیدگاه</div>

                                            <div class="col-span-2">
                                                <!-- comment title -->
                                            </div>
                                            <div class="col-span-2">
                                                <!-- Suggestion -->
                                                <div class="mb-4 text-sm text-text/60">
                                                    این محصول را به دیگران پیشنهاد
                                                </div>
                                                <fieldset class="flex items-center gap-4">
                                                    <legend class="sr-only">Suggestion</legend>

                                                    <div class="w-full">
                                                        <input type="radio" name="suggested" value="1"
                                                            id="suggest-like" class="peer hidden" />

                                                        <label for="suggest-like"
                                                            class="relative block cursor-pointer rounded-lg border p-2 shadow-base peer-checked:border-emerald-500 hover:border-border/50 peer-checked:dark:border-emerald-400 dark:hover:border-white/10">
                                                            <div class="flex items-center gap-x-2 text-primary">
                                                                <svg class="h-5 w-5">
                                                                    <use xlink:href="#like" />
                                                                </svg>
                                                                <p class="text-sm xs:text-base">میکنم</p>
                                                            </div>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="suggested" value="0"
                                                            id="suggest-dislike" class="peer hidden" />

                                                        <label for="suggest-dislike"
                                                            class="relative block cursor-pointer rounded-lg border p-2 shadow-base peer-checked:border-red-500 hover:border-border/50 peer-checked:dark:border-red-400 dark:hover:border-white/10">
                                                            <div
                                                                class="flex items-center gap-x-2 text-red-500 dark:text-red-400">
                                                                <svg class="h-5 w-5">
                                                                    <use xlink:href="#dislike" />
                                                                </svg>
                                                                <p class="text-sm xs:text-base">نمیکنم</p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-span-2">
                                                <div class="rating" id="rating">
                                                    <span class="star" data-value="1">★</span>
                                                    <span class="star" data-value="2">★</span>
                                                    <span class="star" data-value="3">★</span>
                                                    <span class="star" data-value="4">★</span>
                                                    <span class="star" data-value="5">★</span>
                                                </div>
                                                <input type="hidden" id="rating-value" name="rate" value="0">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="comment"
                                                    class="relative block rounded-lg border shadow-base">
                                                    <textarea type="text" id="comment" name="body" rows="3"
                                                        class="main-scroll peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                                        placeholder="متن دیدگاه"></textarea>
                                                    @error('body')
                                                        {{ $message }}
                                                    @enderror

                                                    <span
                                                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-6 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                                        متن دیدگاه
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-span-2 flex justify-end">
                                                <button type="submit" class="btn-primary w-full px-4 py-2 md:w-auto">
                                                    ارسال دیدگاه
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="col-span-12 md:col-span-4 lg:col-span-3">
                                    <div class="grid grid-cols-2 gap-4 md:sticky md:top-32">

                                        <div class="text-lg">ثبت دیدگاه</div>

                                        <div class="col-span-2">
                                            <!-- comment title -->
                                        </div>
                                        <div class="col-span-2">
                                            <!-- Suggestion -->
                                            <div class="mb-4 text-sm text-text/60">
                                                برای ثبت دیدگاه ابتدا <a href="{{ route('login') }}"
                                                    class="text-primary">وارد شوید</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Comments -->
                            <div class="order-first col-span-12 mb-10 max-h-[500px] overflow-hidden md:order-last md:col-span-8 lg:col-span-9"
                                id="commentsContainer">
                                <div>
                                    <ul class="mb-8 space-y-4 divide-y divide-gray-200 dark:divide-white/10">
                                        @forelse ($comments as $comment)
                                            <li class="space-y-2">
                                                <div class="mt-4 flex items-center gap-x-4 pb-6">
                                                    @if ($comment->suggested)
                                                        <div class="flex items-center gap-x-2 text-primary">

                                                            <svg class="h-5 w-5">
                                                                <use xlink:href="#like" />
                                                            </svg>
                                                            <span class="hidden md:block">
                                                                پیشنهاد میکنم
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="flex items-center gap-x-2 text-red-500 dark:text-red-400">
                                                            <svg class="h-5 w-5">
                                                                <use xlink:href="#dislike" />
                                                            </svg>
                                                            <span class="hidden md:block">
                                                                پیشنهاد نمیکنم
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div class="flex items-center gap-x-2">
                                                        <div class="text-sm text-text/60">
                                                            {{ Jalalian::forge($comment->created_at)->format('%B %d، %Y') }}
                                                        </div>
                                                        <span
                                                            class="h-3 w-px rounded-full bg-background dark:bg-muted/10"></span>
                                                        <div class="text-sm text-text/60">{{ $comment->user->name }}
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-end items-center flex-grow">
                                                        @for ($i = 0; $i < $comment->rate; $i++)
                                                            <span class="star filled">★</span>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $comment->rate; $i++)
                                                            <span class="star">★</span>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="py-2">
                                                    <div class="flex items-center justify-between gap-2">
                                                        <h5 class="mb-4 leading-relaxed xl:text-lg">
                                                            {{ $comment->body }}
                                                        </h5>
                                                        <button data-comment-id="{{ $comment->id }}"
                                                            class="btn-secondary-nobg reply-btn" type="button">
                                                            پاسخ
                                                            <svg class="w-5 h-5">
                                                                <use xlink:href="#chevron-left" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="flex items-center justify-between gap-x-8">
                                                        @if (Auth::check())
                                                            <div class="text-sm text-text/60">
                                                                آیا این دیدگاه برایتان مفید بود؟
                                                            </div>
                                                            <!-- like & dislike -->
                                                            <div class="flex gap-x-4">
                                                                <form
                                                                    action="{{ route('product.comment.like', $comment) }}"
                                                                    method="post">
                                                                    @csrf

                                                                    <button type="submit"
                                                                        class="flex items-center gap-x-2 text-primary transition-all duration-200 hover:text-emerald-400 hover:dark:text-primary">
                                                                        <span class="text-sm"> {{ $comment->likes }}
                                                                        </span>
                                                                        <svg class="h-6 w-6">
                                                                            <use xlink:href="#like" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('product.comment.dislike', $comment) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="flex items-center gap-x-2 text-red-500 transition-all duration-200 hover:text-red-400 dark:text-red-400 hover:dark:text-red-500">
                                                                        <span class="text-sm">
                                                                            {{ $comment->dislikes }}</span>
                                                                        <svg class="h-6 w-6 fill-red-500">
                                                                            <use xlink:href="#dislike" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                        <!-- end like & dislike -->
                                                    </div>
                                                </div>
                                                <!-- Answers -->
                                                @if ($comment->answers->count() > 0)
                                                    <ul class="pl-6 border-l dark:border-white/10">
                                                        @foreach ($comment->answers as $answer)
                                                            <li class="py-4">
                                                                <div class="py-4 pr-8 border-r dark:border-white/10">
                                                                    <h5 class="mb-4 leading-relaxed xl:text-lg">
                                                                        {{ $answer->body }}</h5>
                                                                    <div
                                                                        class="mb-6 flex items-center gap-x-4 border-b pb-6">
                                                                        <div
                                                                            class="flex items-center gap-x-2 text-text/60">
                                                                            {{ jdate($answer->created_at) }} -
                                                                            {{ $answer->user->name }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="py-4">
                                                <div class="py-4 pr-8 border-r dark:border-white/10">
                                                    <h5 class="mb-4 leading-relaxed xl:text-lg">
                                                        دیدگاهی برای این محصول ثبت نشده است.
                                                    </h5>
                                                </div>
                                            </li>
                                        @endforelse
                                    </ul>
                                    <div>
                                        {{ $comments->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden justify-center md:flex">
                        <button class="btn-secondary-nobg" id="toggleCommentsButton">
                            مشاهده بیشتر
                            <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <!--my Modal for submitting answers -->
        <div id="submit-answers-to-comments-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden w-full h-full flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">ثبت پاسخ</h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="submit-answers-to-comments-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">بستن مدال</span>
                        </button>
                    </div>
                    <div class="p-4">
                        <form id="answer-form" method="POST" action="{{ route('product.comment.answer', $product) }}">
                            @csrf
                            <input type="hidden" name="comment_id" id="comment-id">
                            <div class="col-span-2">
                                <label for="comment" class="relative block rounded-lg border shadow-base">
                                    <textarea type="text" id="comment" name="body" rows="3"
                                        class="main-scroll peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                        placeholder="متن دیدگاه"></textarea>
                                    @error('body')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <span
                                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-6 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">متن
                                        دیدگاه</span>
                                </label>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn-primary w-full px-4 py-2 md:w-auto">ثبت پاسخ</button>
                            </div>
                        </form>
                    </div>
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
                text: '{{ session('swal-success') }}',
            });
        </script>
    @endif

    @if (session('swal-error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطا',
                text: '{{ session('swal-error') }}',
            });
        </script>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll('.star');
            const ratingValue = document.getElementById('rating-value');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    let value = star.getAttribute('data-value');
                    ratingValue.value = value;

                    // پاک کردن همه ستاره‌ها
                    stars.forEach(s => s.classList.remove('filled'));

                    // پر کردن ستاره‌های موردنظر از راست به چپ
                    stars.forEach(s => {
                        if (s.getAttribute('data-value') <= value) {
                            s.classList.add('filled');
                        }
                    });
                });
            });
        });
    </script>

    <script>
        // تابع برای تغییر وضعیت محتوا
        function setupToggle(containerId, buttonId) {
            const container = document.getElementById(containerId);
            const button = document.getElementById(buttonId);

            if (!container || !button) {
                console.error(`المنت پیدا نشد: ${containerId} یا ${buttonId}`);
                return;
            }

            console.log(`ارتفاع ${containerId}: ${container.scrollHeight}px`);
            const fullHeight = container.scrollHeight;
            if (fullHeight <= 500) {
                button.style.display = "none";
                container.classList.remove("max-h-[500px]");
                return;
            }

            button.addEventListener("click", () => {
                console.log(`دکمه ${buttonId} کلیک شد`);
                if (container.style.maxHeight === "500px") {
                    container.style.maxHeight = "none";
                    button.innerHTML = 'بستن <svg class="h-5 w-5"><use xlink:href="#chevron-left"/></svg>';
                } else {
                    container.style.maxHeight = "500px";
                    button.innerHTML = 'مشاهده بیشتر <svg class="h-5 w-5"><use xlink:href="#chevron-left"/></svg>';
                }
            });

        }

        // مدیریت مدال پاسخ
        function setupReplyModal() {
            const replyButtons = document.querySelectorAll('.reply-btn');
            const commentIdInput = document.getElementById('comment-id');
            const modal = document.getElementById('submit-answers-to-comments-modal');
            const closeModalBtn = modal ? modal.querySelector('[data-modal-hide]') : null;

            if (!replyButtons.length) console.error("دکمه‌های پاسخ پیدا نشدند!");
            if (!commentIdInput) console.error("ورودی comment-id پیدا نشد!");
            if (!modal) console.error("مدال submit-answers-to-comments-modal پیدا نشد!");
            if (!closeModalBtn) console.error("دکمه بستن مدال پیدا نشد!");

            replyButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const commentId = button.getAttribute('data-comment-id');
                    console.log(`پاسخ برای کامنت ${commentId} کلیک شد`);
                    commentIdInput.value = commentId;
                    modal.classList.remove('hidden');
                });
            });

            closeModalBtn.addEventListener('click', () => {
                console.log("مدال بسته شد");
                modal.classList.add('hidden');
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            console.log("DOM لود شد");
            setupToggle("descriptionContainer", "toggleDescriptionButton");
            setupToggle("specsContainer", "toggleSpecsButton");
            setupToggle("commentsContainer", "toggleCommentsButton");
            setupToggle("descriptionContainer", "descriptionButtonMobile");
            setupToggle("specsContainer", "specsButtonMobile");

            setupReplyModal();
        });

        const copyToClipboardSocialShareDesktop = (button) => {
            const linkToCopy = button.getAttribute("data-link");
            if (linkToCopy) {
                navigator.clipboard
                    .writeText(linkToCopy)
                    .then(function() {
                        const copyToClipboardSocialShareText = document.getElementById(
                            "copyToClipboardSocialShareText",
                        );
                        copyToClipboardSocialShareText.innerText = "کپی شد !";

                        // Revert the text after 5 seconds
                        setTimeout(function() {
                            copyToClipboardSocialShareText.innerText = "کپی کردن لینک";
                        }, 5000);
                    })
                    .catch(function(err) {
                        console.error("مشکلی در عملیات پیش آمد", err);
                    });
            }
        };
        const copyToClipboardSocialShareMobile = (button) => {
            const linkToCopy = button.getAttribute("data-link");
            console.log(linkToCopy);
            if (linkToCopy) {
                navigator.clipboard
                    .writeText(linkToCopy)
                    .then(function() {
                        const copyToClipboardSocialShareNotifyMobile =
                            document.getElementById(
                                "notify-copied-social-share-link-mobile",
                            );
                        copyToClipboardSocialShareNotifyMobile.classList.remove("hidden");

                        // Revert the text after 5 seconds
                        setTimeout(function() {
                            copyToClipboardSocialShareNotifyMobile.classList.add("hidden");
                        }, 5000);
                    })
                    .catch(function(err) {
                        console.error("مشکلی در عملیات پیش آمد", err);
                    });
            }
        };
    </script>




@show

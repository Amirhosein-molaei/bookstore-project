@extends('app.layouts.master')
@section('title', 'صفحه فروشگاه')

@section('content')

<main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
    <div class="container relative">
        <!-- Mobile Options Section -->
        <div class="mb-6 flex items-center justify-center gap-x-4 md:hidden">
            <!-- Filter -->
            <button
                aria-controls="shop-filter-drawer-navigation"
                class="flex w-full items-center gap-x-4 rounded-lg bg-muted px-4 py-3 text-sm xs:text-base"
                data-drawer-show="shop-filter-drawer-navigation"
                data-drawer-placement="bottom"
                data-drawer-target="shop-filter-drawer-navigation"
                type="button">
                <svg class="h-6 w-6">
                    <use xlink:href="#filter" />
                </svg>
                <div>فیلتر</div>
            </button>
            <!-- Sort -->
            <button
                aria-controls="shop-sort-drawer-navigation"
                class="flex w-full items-center gap-x-4 rounded-lg bg-muted px-4 py-3 text-sm xs:text-base"
                data-drawer-show="shop-sort-drawer-navigation"
                data-drawer-placement="bottom"
                data-drawer-target="shop-sort-drawer-navigation"
                type="button">
                <svg class="h-6 w-6">
                    <use xlink:href="#sort" />
                </svg>
                <div>مرتب سازی</div>
            </button>
        </div>

        <div class="grid grid-cols-12 grid-rows-[60px_min(500px,_1fr)] gap-4">
            <!-- Desktop Filter Section -->
            <div class="col-span-4 row-span-2 hidden md:block lg:col-span-3">
                <div class="sticky top-32 mb-4 overflow-hidden rounded-lg bg-muted shadow-base">
                    <div dir="ltr" class="flex max-h-[calc(95vh_-_100px)] flex-col overflow-y-auto overflow-x-hidden px-4 py-3">
                        <div dir="rtl">
                            <!-- Title -->
                            <div class="mb-6 flex items-center justify-between">
                                <h3 class="xl:text-lg">فیلتر ها</h3>
                                <button class="btn-primary-nobg py-2 text-sm">حذف همه</button>
                            </div>
                            <ul class="space-y-6">
                                <!-- Search -->
                                <li>
                                    <label class="sr-only">Shop search</label>
                                    <input
                                        class="w-full rounded-lg border-none bg-background px-2 py-3 text-text/90 outline-none placeholder:text-sm placeholder:text-text/60 focus:ring-0"
                                        placeholder="جستجو در بین نتایج ..."
                                        type="text" />
                                </li>
                                <!-- Price -->
                                <li>
                                    <div>
                                        <p class="mb-4">محدوده قیمت</p>
                                        <div class="space-y-4">
                                            <div id="shop-price-slider"></div>
                                            <div class="flex items-center justify-between">
                                                <div class="text-primary">
                                                    <span class="text-xs font-bold xl:text-sm" id="shop-price-slider-min"></span>
                                                    <span class="text-xs">تومان</span>
                                                </div>
                                                <div class="text-primary">
                                                    <span class="text-xs font-bold xl:text-sm" id="shop-price-slider-max"></span>
                                                    <span class="text-xs">تومان</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Categories -->
                                <li class="relative" data-accordion-item>
                                    <div class="w-full text-right cursor-pointer" data-accordion-button>
                                        <div class="flex items-center justify-between gap-2 text-sm md:text-base">
                                            <span>دسته‌بندی‌ها</span>
                                            <div class="min-w-fit">
                                                <svg data-accordion-chevron class="h-5 w-5 duration-300">
                                                    <use xlink:href="#chevron-left"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative max-h-0 overflow-hidden transition-all duration-300" data-accordion-content>
                                        <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                            <ul class="space-y-2 rounded-lg">
                                                <li><a class="flex items-center gap-x-2 rounded-lg px-4 py-2" href="#"><span>دسته‌بندی 1</span><svg class="h-5 w-5"><use xlink:href="#chevron-left" /></svg></a></li>
                                                <li><a class="flex items-center gap-x-2 rounded-lg px-4 py-2" href="#"><span>دسته‌بندی 2</span><svg class="h-5 w-5"><use xlink:href="#chevron-left" /></svg></a></li>
                                                <li><a class="flex items-center gap-x-2 rounded-lg px-4 py-2" href="#"><span>دسته‌بندی 3</span><svg class="h-5 w-5"><use xlink:href="#chevron-left" /></svg></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Writers -->
                                <li class="relative" data-accordion-item>
                                    <div class="w-full text-right cursor-pointer" data-accordion-button>
                                        <div class="flex items-center justify-between gap-2 text-sm md:text-base">
                                            <span>نویسنده‌ها</span>
                                            <div class="min-w-fit">
                                                <svg data-accordion-chevron class="h-5 w-5 duration-300">
                                                    <use xlink:href="#chevron-left"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative max-h-0 overflow-hidden transition-all duration-300" data-accordion-content>
                                        <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                            <ul class="space-y-2 rounded-lg">
                                                @foreach ($writers as $writer)
                                                    <li>
                                                        <a class="flex items製品-center gap-x-2 rounded-lg px-4 py-2" href="#">
                                                            <span>{{ $writer->name }}</span>
                                                            <svg class="h-5 w-5">
                                                                <use xlink:href="#chevron-left" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Brands -->
                                <li class="relative" data-accordion-item>
                                    <div class="w-full text-right cursor-pointer" data-accordion-button>
                                        <div class="flex items-center justify-between gap-2 text-sm md:text-base">
                                            <span>برندها</span>
                                            <div class="min-w-fit">
                                                <svg data-accordion-chevron class="h-5 w-5 duration-300">
                                                    <use xlink:href="#chevron-left"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative max-h-0 overflow-hidden transition-all duration-300" data-accordion-content>
                                        <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                            <ul class="space-y-2 rounded-lg" id="brandListFilterDesktop">
                                                <li class="p-2">
                                                    <label class="sr-only">Brand search</label>
                                                    <input
                                                        id="brandListFilterDesktopSearchInput"
                                                        class="w-full rounded-lg border-none bg-background px-2 py-3 text-text/90 outline-none placeholder:text-sm placeholder:text-text/60 focus:ring-0"
                                                        placeholder="جستجوی برند ..."
                                                        type="text" />
                                                </li>
                                                <li>
                                                    <div class="flex w-full items-center gap-x-2 pr-4">
                                                        <input id="brand-nike" type="checkbox" value="" class="h-4 w-4 cursor-pointer rounded-xl bg-background dark:border-gray-600 dark:bg-zinc-700" />
                                                        <label for="brand-nike" class="flex w-full cursor-pointer items-center justify-between py-2 pl-4 font-medium text-text/90">
                                                            <span>نایک</span>
                                                            <span>nike</span>
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex w-full items-center gap-x-2 pr-4">
                                                        <input id="brand-adidas" type="checkbox" value="" class="h-4 w-4 cursor-pointer rounded-xl bg-background dark:border-gray-600 dark:bg-zinc-700" />
                                                        <label for="brand-adidas" class="flex w-full cursor-pointer items-center justify-between py-2 pl-4 font-medium text-text/90">
                                                            <span>آدیداس</span>
                                                            <span>adidas</span>
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Colors -->
                                <li class="relative" data-accordion-item>
                                    <div class="w-full text-right cursor-pointer" data-accordion-button>
                                        <div class="flex items-center justify-between gap-2 text-sm md:text-base">
                                            <span>رنگ‌ها</span>
                                            <div class="min-w-fit">
                                                <svg data-accordion-chevron class="h-5 w-5 duration-300">
                                                    <use xlink:href="#chevron-left"></use>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative max-h-0 overflow-hidden transition-all duration-300" data-accordion-content>
                                        <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                            <ul class="space-y-2 rounded-lg" id="colorListFilterDesktop">
                                                <li class="p-2">
                                                    <label class="sr-only">Color search</label>
                                                    <input
                                                        id="colorListFilterDesktopSearchInput"
                                                        class="w-full rounded-lg border-none bg-background px-2 py-3 text-text/90 outline-none placeholder:text-sm placeholder:text-text/60 focus:ring-0"
                                                        placeholder="جستجوی رنگ ..."
                                                        type="text" />
                                                </li>
                                                <li>
                                                    <div class="flex w-full items-center gap-x-2 pr-4">
                                                        <input id="color-red" type="checkbox" value="" class="h-4 w-4 cursor-pointer rounded-xl bg-background dark:border-gray-600 dark:bg-zinc-700" />
                                                        <label for="color-red" class="flex w-full cursor-pointer items-center justify-between py-2 pl-4 font-medium text-text/90">
                                                            <span>قرمز</span>
                                                            <span class="h-4 w-4 rounded-full ring-2 ring-gray-200 dark:ring-zinc-700" style="background: red"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex w-full items-center gap-x-2 pr-4">
                                                        <input id="color-blue" type="checkbox" value="" class="h-4 w-4 cursor-pointer rounded-xl bg-background dark:border-gray-600 dark:bg-zinc-700" />
                                                        <label for="color-blue" class="flex w-full cursor-pointer items-center justify-between py-2 pl-4 font-medium text-text/90">
                                                            <span>آبی</span>
                                                            <span class="h-4 w-4 rounded-full ring-2 ring-gray-200 dark:ring-zinc-700" style="background: blue"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Available -->
                                <li>
                                    <label class="flex cursor-pointer items-center justify-between py-3" for="onlyAvailableDesktop">
                                        <div>فقط کالاهای موجود</div>
                                        <div class="relative inline-flex cursor-pointer items-center">
                                            <input class="peer sr-only" id="onlyAvailableDesktop" type="checkbox" />
                                            <div class="peer h-6 w-11 rounded-full bg-background after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:bg-muted after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-focus:ring-emerald-500 dark:bg-zinc-800"></div>
                                        </div>
                                    </label>
                                </li>
                                <!-- Special -->
                                <li>
                                    <label class="flex cursor-pointer items-center justify-between py-3" for="onlySpecialDesktop">
                                        <div>فقط محصولات ویژه</div>
                                        <div class="relative inline-flex cursor-pointer items-center">
                                            <input class="peer sr-only" id="onlySpecialDesktop" type="checkbox" />
                                            <div class="peer h-6 w-11 rounded-full bg-background after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:bg-muted after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-focus:ring-emerald-500 dark:bg-zinc-800"></div>
                                        </div>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 space-y-4 md:col-span-8 lg:col-span-9">
                <!-- Desktop Sort Section -->
                <div class="hidden md:block">
                    <div class="flex h-14 items-center gap-x-2 rounded-lg bg-muted px-2 text-text/90 shadow-base lg:px-4">
                        <!-- Title -->
                        <div class="flex items-center gap-x-2 text-sm lg:text-base">
                            <svg class="h-6 w-6">
                                <use xlink:href="#sort" />
                            </svg>
                            <p>مرتب‌سازی بر اساس</p>
                        </div>
                        <!-- Sort Buttons -->
                        <a href="{{ route('shop.index') }}">
                            <button class="btn {{ $sort === 'all' ? 'btn-primary' : 'btn-outline-primary' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                همه کالاها
                            </button>
                        </a>
                        <form action="{{ route('shop.index', 'available') }}" method="get">
                            @csrf
                            <button type="submit" class="btn {{ $sort === 'available' ? 'btn-primary' : 'btn-outline-primary' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                کالاهای موجود
                            </button>
                        </form>
                        <form action="{{ route('shop.index', 'with-picture') }}" method="get">
                            @csrf
                            <button type="submit" class="btn {{ $sort === 'with-picture' ? 'btn-primary' : 'btn-outline-primary' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                کالاهای عکس‌دار
                            </button>
                        </form>
                        <form action="{{ route('shop.index', 'most-expensive') }}" method="get">
                            @csrf
                            <button type="submit" class="btn {{ $sort === 'most-expensive' ? 'btn-primary' : 'btn-outline-primary' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                گران‌ترین
                            </button>
                        </form>
                        <form action="{{ route('shop.index', 'cheapest') }}" method="get">
                            @csrf
                            <button type="submit" class="btn {{ $sort === 'cheapest' ? 'btn-primary' : 'btn-outline-primary' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                ارزان‌ترین
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-2 gap-px gap-y-2 xs:gap-4 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <!-- Product Card -->
                    @foreach ($products as $product)
                        <div class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                            <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                <!-- Image -->
                                <div class="mb-2 md:mb-5" draggable="false">
                                    <a href="{{ route('product', $product) }}">
                                        <img alt="" class="mx-auto w-32 rounded-lg md:w-auto" src="{{ asset($product->image) }}" />
                                    </a>
                                </div>
                                <!-- Title -->
                                <div class="mb-1">
                                    <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base" href="{{ route('product', $product) }}">
                                        {{ $product->title }}
                                    </a>
                                </div>
                                <!-- Prices -->
                                <div class="flex flex-col">
                                    <!-- Old price -->
                                    <div class="h-5 text-left">
                                        <del class="text-sm text-text/60 decoration-warning md:text-base">
                                            {{ $product->discounted_price ? number_format($product->price) : '' }}
                                        </del>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    @if ($product->discount_percentage)
                                        <div>
                                            <p class="w-7 rounded-full bg-warning py-px text-center text-xs text-white xs:w-9 xs:text-sm">
                                                {{ $product->discount_percentage }}%
                                            </p>
                                        </div>
                                    @endif
                                    <!-- New price -->
                                    <div class="text-xs font-bold text-primary xs:text-sm md:text-base">
                                        {{ $product->discounted_price ? number_format($product->discounted_price) : number_format($product->price) }}
                                        <span class="text-xs font-light md:text-sm">تومان</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-center gap-x-4 md:justify-end mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
@parent
<script>
    const addSearchFunctionality = (searchInput, itemList) => {
        searchInput.addEventListener("input", function () {
            const searchTerm = searchInput.value.trim().toLowerCase();
            const items = itemList.querySelectorAll("li:not(:first-child)"); // Exclude the first <li> with the search input.

            items.forEach(function (item) {
                const brandName = item.querySelector("span:first-child").textContent.toLowerCase();
                const brandCode = item.querySelector("span:last-child")?.textContent.toLowerCase() || '';

                if (brandName.includes(searchTerm) || brandCode.includes(searchTerm)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    };

    const brandListSearchInputDesktop = document.getElementById("brandListFilterDesktopSearchInput");
    const brandListDesktop = document.getElementById("brandListFilterDesktop");
    const colorListSearchInputDesktop = document.getElementById("colorListFilterDesktopSearchInput");
    const colorListDesktop = document.getElementById("colorListFilterDesktop");

    if (brandListSearchInputDesktop && brandListDesktop) {
        addSearchFunctionality(brandListSearchInputDesktop, brandListDesktop);
    }
    if (colorListSearchInputDesktop && colorListDesktop) {
        addSearchFunctionality(colorListSearchInputDesktop, colorListDesktop);
    }
</script>
@endsection
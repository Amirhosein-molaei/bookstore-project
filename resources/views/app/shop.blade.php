@extends('app.layouts.master')
@section('title', 'صفحه فروشگاه')

@section('content')
        <div class="container relative">
            <!-- Mobile Options Section -->
            <div class="mb-6 flex items-center justify-center gap-x-4 md:hidden">
                <!-- Filter -->
                <button aria-controls="shop-filter-drawer-navigation"
                    class="flex w-full items-center gap-x-4 rounded-lg bg-muted px-4 py-3 text-sm xs:text-base"
                    data-drawer-show="shop-filter-drawer-navigation" data-drawer-placement="bottom"
                    data-drawer-target="shop-filter-drawer-navigation" type="button">
                    <svg class="h-6 w-6">
                        <use xlink:href="#filter" />
                    </svg>
                    <div>فیلتر</div>
                </button>
                <!-- Sort -->
                <button aria-controls="shop-sort-drawer-navigation"
                    class="flex w-full items-center gap-x-4 rounded-lg bg-muted px-4 py-3 text-sm xs:text-base"
                    data-drawer-show="shop-sort-drawer-navigation" data-drawer-placement="bottom"
                    data-drawer-target="shop-sort-drawer-navigation" type="button">
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
                        <div dir="ltr"
                            class="flex max-h-[calc(95vh_-_100px)] flex-col overflow-y-auto overflow-x-hidden px-4 py-3">
                            <div dir="rtl">
                                <!-- Title -->
                                <div class="mb-6 flex items-center justify-between">
                                    <h3 class="xl:text-lg">فیلتر ها</h3>
                                    <a class="btn-primary-nobg py-2 text-sm" href="{{ route('shop') }}">
                                        حذف همه
                                    </a>
                                </div>
                                <ul class="space-y-6">
                                    <!-- Search -->
                                    <li>
                                        <label class="sr-only">Shop search</label>
                                        <input
                                            class="w-full rounded-lg border-none bg-background px-2 py-3 text-text/90 outline-none placeholder:text-sm placeholder:text-text/60 focus:ring-0 placeholder:"
                                            placeholder="جستجو در بین نتایج ..." type="text" />
                                    </li>
                                    <!-- Price -->
                                    <li>
                                        <div>
                                            <p class="mb-4">محدوده قیمت</p>
                                            <div class="space-y-4">
                                                <form id="priceFilter" action="{{ route('shop', request()->query()) }}"
                                                    method="get">
                                                    {{-- prevent of loosing category and sort by submiting the form --}}

                                                    @if (request('category'))
                                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                                    @endif

                                                    @if (request('filter'))
                                                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                                                    @endif
                                                    
                                                    <label for="min_price"
                                                        class="relative block rounded-lg border shadow-base mb-2">
                                                        <input type="number" id="min_price" dir="auto" name="min_price"
                                                            class="peer w-full rounded-lg border-none bg-transparent p-2 text-left placeholder-transparent focus:outline-none focus:ring-0"
                                                            placeholder="از (تومان)" value="{{ request('min_price') }}">

                                                        <span
                                                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                                            از (تومان)
                                                        </span>
                                                    </label>
                                                    <label for="max_price"
                                                        class="relative block rounded-lg border shadow-base">
                                                        <input type="number" id="max_price" dir="auto" name="max_price"
                                                            class="peer w-full rounded-lg border-none bg-transparent p-2 text-left placeholder-transparent focus:outline-none focus:ring-0"
                                                            placeholder="تا (تومان)" value="{{ request('max_price') }}">

                                                        <span
                                                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                                            تا (تومان)
                                                        </span>
                                                    </label>
                                                    <button type="submit" class="btn-primary w-full px-2 py-1 mt-4">
                                                        اعمال
                                                    </button>
                                                </form>
                                                {{-- <div class="flex items-center justify-between">
                                                    <div class="text-primary">
                                                        <span class="text-xs font-bold xl:text-sm"
                                                            id="shop-price-slider-min">0</span>
                                                        <span class="text-xs">تومان</span>
                                                    </div>
                                                    <div class="text-primary">
                                                        <span class="text-xs font-bold xl:text-sm"
                                                            id="shop-price-slider-max">100,000,000</span>
                                                        <span class="text-xs">تومان</span>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Categories -->

                                    <li class="relative" data-accordion-item>
                                        <div class="w-full text-right cursor-pointer" data-accordion-button>
                                            <div class="flex items-center justify-between gap-2 text-sm md:text-base">
                                                <span> دسته بندی ها </span>
                                                <div class="min-w-fit">
                                                    <svg data-accordion-chevron class="h-5 w-5 duration-300">
                                                        <use xlink:href="#chevron-left"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="relative max-h-0 overflow-hidden transition-all duration-300"
                                            data-accordion-content>
                                            <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                                <ul class="space-y-2 rounded-lg">
                                                    @foreach ($categories->where('parent_id', null) as $category)
                                                        <li
                                                            {{ $category->subCategories->count() > 0 ? 'data-accordion-item' : '' }}>

                                                            @if ($category->subCategories->count() > 0)
                                                                <div class="w-full text-right cursor-pointer"
                                                                    data-accordion-button>
                                                                    <div
                                                                        class="flex items-center justify-between gap-x-2 px-4 py-2 text-sm md:text-base">
                                                                        <span> {{ $category->name }} </span>
                                                                        <div class="min-w-fit">
                                                                            <svg data-accordion-chevron
                                                                                class="h-5 w-5 duration-300">
                                                                                <use xlink:href="#chevron-left"></use>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="relative max-h-0 overflow-hidden transition-all duration-300"
                                                                    data-accordion-content>
                                                                    <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                                                        <ul class="space-y-2 rounded-lg">

                                                                            <li class="mr-4">
                                                                                <a class="flex items-center gap-x-2 rounded-lg px-4 py-2 {{ $category->slug == request()->category ? 'text-primary' : '' }}"
                                                                                    href="{{ route('shop', ['category' => $category->slug] + request()->query()) }}">
                                                                                    <span> همه کتاب ها </span>
                                                                                </a>
                                                                            </li>

                                                                            @foreach ($category->subCategories as $subCategory)
                                                                                <li class="mr-4">
                                                                                    <a class="flex items-center gap-x-2 rounded-lg px-4 py-2 {{ $subCategory->slug == request()->category ? 'text-primary' : '' }}"
                                                                                        href="{{ route('shop', ['category' => $subCategory->slug] + request()->query()) }}">
                                                                                        <span>
                                                                                            {{ $subCategory->name }}
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a class="flex items-center gap-x-2 rounded-lg px-4 py-2 {{ $category->slug == request()->category ? 'text-primary' : '' }}"
                                                                    href="{{ route('shop', ['category' => $category->slug] + request()->query()) }}">
                                                                    <span> {{ $category->name }} </span>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- brands -->

                                    {{-- <li class="relative" data-accordion-item>
                                        <div class="w-full text-right cursor-pointer" data-accordion-button>
                                            <div class="flex items-center justify-between gap-2 text-sm md:text-base">
                                                <span> برند ها </span>
                                                <div class="min-w-fit">
                                                    <svg data-accordion-chevron class="h-5 w-5 duration-300">
                                                        <use xlink:href="#chevron-left"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="relative max-h-0 overflow-hidden transition-all duration-300"
                                            data-accordion-content>
                                            <div class="mt-4 max-h-60 overflow-y-auto pl-1">
                                                <ul class="space-y-2 rounded-lg" id="brandListFilterDesktop">
                                                    <li class="p-2">
                                                        <label class="sr-only">Brand search</label>
                                                        <input id="brandListFilterDesktopSearchInput"
                                                            class="w-full rounded-lg border border-none bg-background px-2 py-3 text-text/90 outline-none placeholder:text-sm placeholder:text-text/60 focus:ring-0 placeholder:"
                                                            placeholder="جستجوی برند ..." type="text" />
                                                    </li>
                                                    <li>
                                                        <div class="flex w-full items-center gap-x-2 pr-4">
                                                            <input id="brand-nike" type="checkbox" value=""
                                                                class="h-4 w-4 cursor-pointer rounded-xl bg-background dark:border-gray-600 dark:bg-zinc-700" />
                                                            <label for="brand-nike"
                                                                class="flex w-full cursor-pointer items-center justify-between py-2 pl-4 font-medium text-text/90">
                                                                <span>نایک</span>
                                                                <span>nike</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li> --}}


                                    <!-- Available -->
                                    <li>
                                        <label class="flex cursor-pointer items-center justify-between py-3"
                                            for="onlyAvailableDesktop">
                                            <div class=" ">فقط کالا های موجود</div>
                                            <div class="relative inline-flex cursor-pointer items-center">
                                                <input class="peer sr-only" id="onlyAvailableDesktop" type="checkbox" />

                                                <div
                                                    class="peer h-6 w-11 rounded-full bg-background after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:bg-muted after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-focus:ring-emerald-500 dark:bg-zinc-800 after: peer-checked: peer-focus:dark:ring-emerald-400">
                                                </div>
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
                        <div
                            class="flex h-14 items-center gap-x-2 rounded-lg bg-muted px-2 text-text/90 shadow-base lg:px-4">
                            <!-- Title -->
                            <div class="flex items-center gap-x-2 text-sm lg:text-base">
                                <svg class="h-6 w-6">
                                    <use xlink:href="#sort" />
                                </svg>
                                <p>مرتب‌سازی بر اساس</p>
                            </div>
                            <!-- Sort Buttons -->
                            <a href="{{ route('shop', ['filter' => '0'] + request()->query()) }}"
                                class="btn {{ $sort === '0' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                همه کالاها
                            </a>

                            <a href="{{ route('shop', ['filter' => '1'] + request()->query()) }}"
                                class="btn {{ $sort === '1' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                کالاهای موجود
                            </a>

                            <a href="{{ route('shop', ['filter' => '2'] + request()->query()) }}"
                                class="btn {{ $sort === '2' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                کالاهای عکس‌دار
                            </a>

                            <a href="{{ route('shop', ['filter' => '3'] + request()->query()) }}"
                                class="btn {{ $sort === '3' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                گران‌ترین
                            </a>

                            <a href="{{ route('shop', ['filter' => '4'] + request()->query()) }}"
                                class="btn {{ $sort === '4' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm lg:px-4">
                                ارزان‌ترین
                            </a>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div
                        class="grid grid-cols-2 gap-px gap-y-2 xs:gap-4 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        <!-- Product Card -->
                        @foreach ($products as $product)
                            <div
                                class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">

                                <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">

                                    <!-- image -->
                                    <div class="mb-2 md:mb-5" draggable="false">
                                        <a href="{{ route('product', $product) }}">
                                            <img alt="" style="height: 296px"
                                                class="mx-auto w-32 rounded-lg md:w-auto"
                                                src="{{ asset($product->image ?? 'assets/images/products/default-img.jpg') }}" />
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
                                    <div class="mb-1">
                                        <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base"
                                            href="./product-detail.html">
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
                                                <p
                                                    class="w-7 rounded-full bg-warning py-px text-center text-xs text-white xs:w-9 xs:text-sm">
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

                    @if ($products->count() > 12)
                        <!-- Pagination -->
                        <div class="flex items-center justify-center gap-x-4">
                            <!-- Previous Page -->
                            @if (!$products->onFirstPage())
                                <a class="pagination-button flex items-center justify-center"
                                    href="{{ $products->previousPageUrl() }}">
                                    <svg class="h-6 w-6">
                                        <use xlink:href="#chevron-right"></use>
                                    </svg>
                                </a>
                            @endif

                            <!-- Pages -->
                            <div class="flex items-center gap-x-2">
                                @foreach ($products->links()->elements[0] as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <a class="pagination-button pagination-button-active"
                                            href="{{ $products->currentPage() }}">{{ $page }}</a>
                                    @else
                                        <a href="{{ $url }}" class="pagination-button">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Next Page -->
                            @if ($products->hasMorePages())
                                <a class="flex h-8 w-8 items-center justify-center rounded-full bg-muted transition-all duration-200 hover:bg-primary hover:text-white hover:dark:bg-emerald-600"
                                    href="{{ $products->nextPageUrl() }}">
                                    <svg class="h-6 w-6">
                                        <use xlink:href="#chevron-left"></use>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif

                </div>

            </div>
        </div>
        </div>

@endsection

@section('scripts')
    @parent

    <script>
        document.getElementById('priceFilter').addEventListener('submit', function(event) {
            event.preventDefault(); // جلوگیری از ارسال فرم به صورت پیش‌فرض

            // دریافت query string فعلی از URL
            const currentQuery = new URLSearchParams(window.location.search);

            // دریافت مقادیر ورودی‌ها
            const fromValue = document.getElementById('min_price').value;
            const toValue = document.getElementById('max_price').value;

            // اضافه کردن مقادیر جدید به query string
            if (fromValue) {
                currentQuery.set('min_price', fromValue);
            }
            if (toValue) {
                currentQuery.set('max_price', toValue);
            }

            // ساخت query string نهایی
            const queryString = `?${currentQuery.toString()}`;

            // افزودن query string به action فرم
            this.action += queryString;
            // console.log(this.action);

            // ارسال فرم
            this.submit();
        });
    </script>

    <script>
        const addSearchFunctionality = (searchInput, itemList) => {
            searchInput.addEventListener("input", function() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                const items = itemList.querySelectorAll(
                    "li:not(:first-child)"); // Exclude the first <li> with the search input.

                items.forEach(function(item) {
                    const brandName = item
                        .querySelector("span:first-child")
                        .textContent.toLowerCase();
                    const brandCode = item
                        .querySelector("span:last-child")
                        .textContent.toLowerCase();

                    if (
                        brandName.includes(searchTerm) ||
                        brandCode.includes(searchTerm)
                    ) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        };
        const brandListSearchInputDesktop = document.getElementById(
            "brandListFilterDesktopSearchInput",
        );
        const brandListDesktop = document.getElementById(
            "brandListFilterDesktop",
        );

        const brandListSearchInputMobile = document.getElementById(
            "brandListFilterMobileSearchInput",
        );
        const brandListMobile = document.getElementById("brandListFilterMobile");

        const colorListSearchInputDesktop = document.getElementById(
            "colorListFilterDesktopSearchInput",
        );
        const colorListDesktop = document.getElementById(
            "colorListFilterDesktop",
        );

        const colorListSearchInputMobile = document.getElementById(
            "colorListFilterMobileSearchInput",
        );
        const colorListMobile = document.getElementById("colorListFilterMobile");

        addSearchFunctionality(brandListSearchInputDesktop, brandListDesktop);
        addSearchFunctionality(brandListSearchInputMobile, brandListMobile);

        addSearchFunctionality(colorListSearchInputDesktop, colorListDesktop);
        addSearchFunctionality(colorListSearchInputMobile, colorListMobile);
    </script>


@show

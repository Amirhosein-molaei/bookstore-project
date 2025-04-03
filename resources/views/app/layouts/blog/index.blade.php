@extends('app.layouts.master')
@section('title', 'صفحه بلاگ')

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
                    type="button"
                >
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
                    type="button"
                >
                    <svg class="h-6 w-6">
                        <use xlink:href="#sort" />
                    </svg>
                    <div>مرتب سازی</div>
                </button>
            </div>

            <div class="grid grid-cols-12 grid-rows-[60px_min(500px,_1fr)] gap-4">
                <!-- Desktop Filter Section -->
                <div class="col-span-4 row-span-2 hidden md:block lg:col-span-3">
                    <div
                        class="sticky top-32 mb-4 overflow-hidden rounded-lg bg-muted shadow-base"
                    >
                        <div
                            dir="ltr"
                            class="flex max-h-[calc(95vh_-_100px)] flex-col overflow-y-auto overflow-x-hidden px-4 py-3"
                        >
                            <div dir="rtl">
                                <!-- Title -->
                                <div class="mb-6 flex items-center justify-between">
                                    <h3 class="xl:text-lg">فیلتر ها</h3>
                                    <button class="btn-primary-nobg py-2 text-sm">
                                        حذف همه
                                    </button>
                                </div>
                                <ul class="space-y-6">
                                    <!-- Search -->
                                    <li>
                                        <form action="{{ route('blogs.index') }}" method="GET">
                                            <label class="sr-only">جستجوی بلاگ</label>
                                            <div class="relative">
                                                <input
                                                    type="text"
                                                    name="search"
                                                    value="{{ $searchTerm ?? '' }}"
                                                    class="w-full rounded-lg border-none bg-background px-2 py-3 text-text/90 outline-none placeholder:text-sm placeholder:text-text/60 focus:ring-0"
                                                    placeholder="جستجو در بین بلاگ‌ها..."
                                                />
                                                <button type="submit" class="absolute left-2 top-3 text-text/60">

                                                </button>
                                            </div>
                                            <!-- حفظ پارامترهای موجود در URL -->
                                            @if(request('sort'))
                                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                            @endif
                                            @if(request('category'))
                                                <input type="hidden" name="category" value="{{ request('category') }}">
                                            @endif
                                        </form>
                                    </li>
                                    <!-- Categories -->
                                    <li>
                                        <details
                                            class="[&amp;_summary::-webkit-details-marker]:hidden group"
                                        >
                                            <summary
                                                class="flex cursor-pointer items-center justify-between rounded-lg py-3"
                                            >
                                                <span> دسته بندی ها </span>
                                                <span
                                                    class="shrink-0 transition duration-200 group-open:-rotate-90"
                                                >
                              <svg class="h-5 w-5">
                                <use xlink:href="#chevron-left" />
                              </svg>
                            </span>
                                            </summary>
                                            <!-- در بخش دسته‌بندی‌ها -->
                                            <ul class="mt-2 max-h-60 space-y-2 overflow-y-auto rounded-lg bg-background dark:bg-zinc-800">
                                                @foreach($categories as $category)
                                                    <li>
                                                        <a href="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}"
                                                           class="flex items-center gap-x-2 rounded-lg px-4 py-2 hover:text-primary {{ request('category') == $category->id ? 'text-primary' : '' }}">
                                                            <span>{{ $category->name }}</span>
                                                            @if($category->children->count())
                                                                <svg class="h-5 w-5">
                                                                    <use xlink:href="#chevron-left" />
                                                                </svg>
                                                            @endif
                                                        </a>

                                                        @if($category->children->count())
                                                            <ul class="mr-4 mt-2 space-y-2">
                                                                @foreach($category->children as $child)
                                                                    <li>
                                                                        <a href="{{ request()->fullUrlWithQuery(['category' => $child->id]) }}"
                                                                           class="flex items-center gap-x-2 rounded-lg px-4 py-2 text-sm hover:text-primary {{ request('category') == $child->id ? 'text-primary' : '' }}">
                                                                            <span>{{ $child->name }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    </li>
                                    <!-- Hot -->
                                    <li>
                                        <label
                                            class="flex cursor-pointer items-center justify-between py-3"
                                            for="onlyHotDesktop"
                                        >

                                            <div
                                                class="relative inline-flex cursor-pointer items-center"
                                            >
                                                <input
                                                    class="peer sr-only"
                                                    id="onlyHotDesktop"
                                                    type="checkbox"
                                                />

                                                <div
                                                    class="peer h-6 w-11 rounded-full bg-background after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:bg-muted after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-focus:ring-emerald-500 dark:bg-zinc-800 after: peer-checked: peer-focus:dark:ring-emerald-400"
                                                ></div>
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
                            class="flex h-14 items-center gap-x-2 rounded-lg bg-muted px-2 text-text/90 shadow-base lg:px-4"
                        >
                            <!-- Title -->
                            <div class="flex items-center gap-x-2 text-sm lg:text-base">
                                <svg class="h-6 w-6">
                                    <use xlink:href="#sort" />
                                </svg>
                                <p>مرتب سازی بر اساس</p>
                            </div>
                            <!-- Sort Buttons -->
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}"
                                class="{{ $sort === 'latest' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm hover:bg-background lg:px-4"
                            >
                                جدید ترین
                            </a>
                            <a
                                href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}"
                                class="{{ $sort === 'popular' ? 'sort-button-active' : '' }} rounded-lg px-1 py-2 text-sm hover:bg-background lg:px-4"
                            >
                                پربازدید ترین
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-px gap-y-2 xs:gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($blogs as $blog)
                            <div class="border-gradient group relative rounded-base p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                                <div>
                                    <a href="{{ route('blogs.show', $blog->id) }}">
                                        <div class="relative rounded-xl bg-muted p-2 shadow-base">
                                            <!-- image -->
                                            <div class="mb-2 md:mb-5" draggable="false">
                                                <img
                                                    alt="{{ $blog->title }}"
                                                    class="mx-auto w-auto rounded-lg rounded-bl-3xl"
                                                    src="{{ asset($blog->image) }}"
                                                />
                                            </div>
                                            <!-- title -->
                                            <div class="mb-2">
                                                <p class="line-clamp-2 h-12 text-sm md:text-base">
                                                    {{ $blog->title }}
                                                </p>
                                            </div>
                                            <div class="flex justify-end">
                                                <p class="text-xs text-primary xs:text-sm">
                                                    {{ jdate($blog->created_at)->format('d / F / Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-center gap-x-4 md:justify-end">
                        {{ $blogs->links() }}
                    </div>

                    </div>
                </div>
            </div>
    </main>
@endsection

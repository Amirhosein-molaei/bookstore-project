@extends('app.layouts.master')
{{--@section('title', $blog->title)--}}

@section('content')
    <main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
        <div class="container relative">
            <div class="mb-6 hidden md:block">
                <nav
                    aria-label="Breadcrumb"
                    class="w-fit rounded-lg bg-muted px-4 py-4 shadow-base"
                >
                    <ol
                        class="flex flex-wrap items-center justify-center gap-x-2 gap-y-4"
                    >
                        <li class="flex items-center gap-x-2">
                            <a
                                href="{{route('app.home')}}"
                                class="text-sm text-text/90 hover: hover:"
                            >
                                خانه
                            </a>
                            <span class="text-text/90">
                    <svg class="h-5 w-5">
                      <use xlink:href="#chevron-left"></use>
                    </svg>
                  </span>
                        </li>
                        <li class="flex items-center gap-x-2">
                            <a href="{{route('blogs.index')}}" class="text-sm text-text/90 hover: hover:">
                                وبلاگ
                            </a>
                            <span class="text-text/90">
                    <svg class="h-5 w-5">
                      <use xlink:href="#chevron-left"></use>
                    </svg>
                  </span>
                        </li>

                        <li>
                            <p class="text-sm text-text/90 hover: hover:">جزئیات وبلاگ </p>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="mb-4 flex flex-wrap items-center gap-2 md:hidden">
                <div
                    class="flex items-center gap-x-1 text-sm font-light text-primary sm:text-base md:text-base"
                >
                    <a href="./index.html"> روتی کالا </a>
                    <svg class="h-5 w-5">
                        <use xlink:href="#chevron-left"></use>
                    </svg>
                </div>
                <div
                    class="flex items-center gap-x-1 text-sm font-light text-primary sm:text-base md:text-base"
                >
                    <a href="./index.html"> وبلاگ </a>
                    <svg class="h-5 w-5">
                        <use xlink:href="#chevron-left"></use>
                    </svg>
                </div>
                <div
                    class="line-clamp-1 text-sm font-light text-primary sm:text-base md:text-base"
                >
                    وبلاگ تست
                </div>
            </div>
            <div class="grid grid-cols-12 grid-rows-[60px_min(500px,_1fr)] gap-4">
                <div class="col-span-12 space-y-4 md:col-span-8 lg:col-span-9">
                    <div class="rounded-lg bg-muted p-3 shadow-base md:p-5">
                        <h1 class="mb-8 font-medium md:text-xl">
                            {{$blog->title}}
                        </h1>

                        <div
                            class="mb-8 flex flex-col items-center justify-between gap-4 xs:flex-row"
                        >
                            <div class="flex items-center gap-x-2 text-sm text-text/90">
                                <div class="flex items-center gap-x-2">
                                    <svg class="h-5 w-5">
                                        <use xlink:href="#user" />
                                    </svg>
                                    <p class="font-medium">{{ $blog->user?->name ?? 'ناشناس' }}</p>
                                </div>
                                <div class="h-3 w-px rounded-full bg-background"></div>
                                <div>  {{ jdate($blog->created_at)->format('d / F / Y') }}</div>
                            </div>
                            <div>

                                <!-- Dropdown menu -->
                                <div
                                    class="z-10 !ml-5 hidden w-50 overflow-hidden rounded-lg border bg-muted shadow-base"
                                    id="copy-social-share-link"
                                >
                                    <ul class="space-y-2 p-2">
                                        <li>
                                            <button
                                                type="button"
                                                data-link="https://www.google.com"
                                                onclick="copyToClipboardSocialShareDesktop(this)"
                                                class="flex w-full items-center justify-between rounded-lg px-4 py-3 text-sky-500 hover:bg-sky-500/10 dark:text-sky-400 dark:hover:bg-sky-400/10"
                                            >
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
                        <div class="mb-8">
                            <img
                                src="{{ asset($blog->image) }}"
                                alt="blog"
                                class="w-full rounded-xl"
                            />
                        </div>
                        <div class="leading-loose text-text/90">
                            <p class="mb-6">
                                {{$blog->body}}
                            </p>

                        </div>
                    </div>
                </div>
                <!-- Desktop Filter Section -->
                <div class="col-span-4 row-span-2 hidden md:block lg:col-span-3">
                    <div class="sticky top-32 mb-4 overflow-hidden">
                        <!-- related Blogs -->
                        <div
                            class="mb-8 rounded-lg bg-muted px-2 py-3 shadow-base xl:px-4"
                        >
                            <p class="mb-4 text-center text-sm font-medium xl:text-base">
                                مطالب مرتبط
                            </p>
                            <ul class="space-y-8">
                              @foreach($blogs as $blogList)
                                <li>
                                    <a href="{{ route('blogs.show', $blogList->id) }}">
                                        <div class="flex gap-x-2 xl:gap-x-4">
                                            <div class="min-w-fit">
                                                <img
                                                    src="{{asset($blogList->image)}}"
                                                    alt="blog"
                                                    class="w-25 rounded-xl xl:w-32"
                                                />
                                            </div>
                                            <div class="flex flex-col gap-y-2">
                                                <p
                                                    class="line-clamp-2 text-sm text-text/90 xl:text-base"
                                                >
                                                    {{$blogList->title}}
                                                </p>
                                                <p class="text-xs text-text/60 xl:text-sm">
                                                    {{ jdate($blogList->created_at)->format('d / F / Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                                <li>
                                    <a href="{{route('blogs.index')}}" class="btn-primary py-2">
                                        مشاهده همه
                                    </a>
                                </li>
                            </ul>
                        </div>
{{--                        <!-- hot Blogs -->--}}
{{--                        <div--}}
{{--                            class="mb-8 rounded-lg bg-muted px-2 py-3 shadow-base xl:px-4"--}}
{{--                        >--}}
{{--                            <p class="mb-4 text-center text-sm font-medium xl:text-base">--}}
{{--                                مطالب محبوب--}}
{{--                            </p>--}}
{{--                            <ul class="space-y-8">--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <div class="flex gap-x-2 xl:gap-x-4">--}}
{{--                                            <div class="min-w-fit">--}}
{{--                                                <img--}}
{{--                                                    src="./assets/images/blog/blog1.jpg"--}}
{{--                                                    alt="blog"--}}
{{--                                                    class="w-25 rounded-xl xl:w-32"--}}
{{--                                                />--}}
{{--                                            </div>--}}
{{--                                            <div class="flex flex-col gap-y-2">--}}
{{--                                                <p--}}
{{--                                                    class="line-clamp-2 text-sm text-text/90 xl:text-base"--}}
{{--                                                >--}}
{{--                                                    نحوه انتقال مخاطبین از گوشی آیفون به اندروید--}}
{{--                                                </p>--}}
{{--                                                <p class="text-xs text-text/60 xl:text-sm">--}}
{{--                                                    1402 / شهریور / 20--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <div class="flex gap-x-2 xl:gap-x-4">--}}
{{--                                            <div class="min-w-fit">--}}
{{--                                                <img--}}
{{--                                                    src="./assets/images/blog/blog1.jpg"--}}
{{--                                                    alt="blog"--}}
{{--                                                    class="w-25 rounded-xl xl:w-32"--}}
{{--                                                />--}}
{{--                                            </div>--}}
{{--                                            <div class="flex flex-col gap-y-2">--}}
{{--                                                <p--}}
{{--                                                    class="line-clamp-2 text-sm text-text/90 xl:text-base"--}}
{{--                                                >--}}
{{--                                                    نحوه انتقال مخاطبین از گوشی آیفون به اندروید--}}
{{--                                                </p>--}}
{{--                                                <p class="text-xs text-text/60 xl:text-sm">--}}
{{--                                                    1402 / شهریور / 20--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <div class="flex gap-x-2 xl:gap-x-4">--}}
{{--                                            <div class="min-w-fit">--}}
{{--                                                <img--}}
{{--                                                    src="./assets/images/blog/blog1.jpg"--}}
{{--                                                    alt="blog"--}}
{{--                                                    class="w-25 rounded-xl xl:w-32"--}}
{{--                                                />--}}
{{--                                            </div>--}}
{{--                                            <div class="flex flex-col gap-y-2">--}}
{{--                                                <p--}}
{{--                                                    class="line-clamp-2 text-sm text-text/90 xl:text-base"--}}
{{--                                                >--}}
{{--                                                    نحوه انتقال مخاطبین از گوشی آیفون به اندروید--}}
{{--                                                </p>--}}
{{--                                                <p class="text-xs text-text/60 xl:text-sm">--}}
{{--                                                    1402 / شهریور / 20--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <!-- Categories Blogs -->--}}
{{--                        <div--}}
{{--                            class="mb-8 rounded-lg bg-muted px-2 py-3 shadow-base xl:px-4"--}}
{{--                        >--}}
{{--                            <p class="mb-4 text-center text-sm font-medium xl:text-base">--}}
{{--                                دسته‌بندی ها--}}
{{--                            </p>--}}
{{--                            <ul class="space-y-4">--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="group py-2">--}}
{{--                                        <div class="flex items-center justify-between">--}}
{{--                                            <p--}}
{{--                                                class="flex items-center gap-x-2 text-sm text-text/90 transition-all duration-200 group-hover: group-hover: xl:text-base"--}}
{{--                                            >--}}
{{--                                                <svg class="h-4 w-4">--}}
{{--                                                    <use xlink:href="#chevron-left" />--}}
{{--                                                </svg>--}}
{{--                                                دسته بندی اول--}}
{{--                                            </p>--}}
{{--                                            <div--}}
{{--                                                class="w-6 rounded-lg bg-primary py-px text-center text-sm font-medium text-white dark:bg-emerald-600"--}}
{{--                                            >--}}
{{--                                                20--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="group py-2">--}}
{{--                                        <div class="flex items-center justify-between">--}}
{{--                                            <p--}}
{{--                                                class="flex items-center gap-x-2 text-sm text-text/90 transition-all duration-200 group-hover: group-hover: xl:text-base"--}}
{{--                                            >--}}
{{--                                                <svg class="h-4 w-4">--}}
{{--                                                    <use xlink:href="#chevron-left" />--}}
{{--                                                </svg>--}}
{{--                                                دسته بندی دوم--}}
{{--                                            </p>--}}
{{--                                            <div--}}
{{--                                                class="w-6 rounded-lg bg-primary py-px text-center text-sm font-medium text-white dark:bg-emerald-600"--}}
{{--                                            >--}}
{{--                                                20--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="group py-2">--}}
{{--                                        <div class="flex items-center justify-between">--}}
{{--                                            <p--}}
{{--                                                class="flex items-center gap-x-2 text-sm text-text/90 transition-all duration-200 group-hover: group-hover: xl:text-base"--}}
{{--                                            >--}}
{{--                                                <svg class="h-4 w-4">--}}
{{--                                                    <use xlink:href="#chevron-left" />--}}
{{--                                                </svg>--}}
{{--                                                دسته بندی سوم--}}
{{--                                            </p>--}}
{{--                                            <div--}}
{{--                                                class="w-6 rounded-lg bg-primary py-px text-center text-sm font-medium text-white dark:bg-emerald-600"--}}
{{--                                            >--}}
{{--                                                20--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="group py-2">--}}
{{--                                        <div class="flex items-center justify-between">--}}
{{--                                            <p--}}
{{--                                                class="flex items-center gap-x-2 text-sm text-text/90 transition-all duration-200 group-hover: group-hover: xl:text-base"--}}
{{--                                            >--}}
{{--                                                <svg class="h-4 w-4">--}}
{{--                                                    <use xlink:href="#chevron-left" />--}}
{{--                                                </svg>--}}
{{--                                                دسته بندی چهارم--}}
{{--                                            </p>--}}
{{--                                            <div--}}
{{--                                                class="w-6 rounded-lg bg-primary py-px text-center text-sm font-medium text-white dark:bg-emerald-600"--}}
{{--                                            >--}}
{{--                                                20--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('app.profile.layouts.master')
@section('title', 'صفحه پروفایل کاربر ')

@section('content')
    <!-- content -->
    <div class="col-span-12 lg:col-span-9">
        <div class="rounded-lg bg-muted p-5 shadow-base">
            <!-- Title -->
            <h1 class="relative mb-16 w-fit text-xl font-medium">
                پیشخوان
                <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                </span>
            </h1>
            <div class="mb-8">
                <h2 class="mb-8 flex items-center gap-x-4 text-lg text-text/90">
                    <span class="h-2 w-2 rounded-full bg-primary"></span>
                    حساب کاربری
                </h2>
                <div class="grid grid-cols-2 gap-4 md:gap-6 xl:grid-cols-4">
                    <a href="{{ route('user-profile.edit') }}"
                        class="flex flex-col items-center gap-4 rounded-base bg-sky-500 p-2 dark:bg-sky-600 md:flex-row">
                        <div class="relative rounded-base bg-sky-600/50 p-2 dark:bg-sky-500/50">
                            <svg class="h-8 w-8 text-white">
                                <use xlink:href="#user-setting" />
                            </svg>
                        </div>

                        <div class="text-sm font-medium text-white md:text-base">
                            تکمیل مشخصات
                        </div>
                    </a>
                    <a href="{{ route('user-profile.edit') }}"
                        class="flex flex-col items-center gap-4 rounded-base bg-warning p-2 dark:bg-red-600 md:flex-row">
                        <div class="relative rounded-base bg-red-600/50 p-2 /50">
                            <svg class="h-8 w-8 text-white">
                                <use xlink:href="#password-lock" />
                            </svg>
                        </div>

                        <div class="text-sm font-medium text-white md:text-base">
                            ثبت کلمه عبور
                        </div>
                    </a>
                    <a href="{{ route('user-profile.product-favorite') }}"
                        class="flex flex-col items-center gap-4 rounded-base bg-rose-500 p-2 dark:bg-rose-600 md:flex-row">
                        <div class="relative rounded-base bg-rose-600/50 p-2 dark:bg-rose-500/50">
                            <svg class="h-8 w-8 text-white">
                                <use xlink:href="#heart" />
                            </svg>
                            <span
                                class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-rose-600 text-sm font-medium text-white dark:bg-rose-500 md:hidden">
                                6
                            </span>
                        </div>

                        <div class="flex items-center gap-x-2 text-sm font-medium text-white md:text-base">
                            <span class="hidden md:block">{{$user->favoriteProducts()->count()}}</span> محصولات محبوب
                        </div>
                    </a>
                    <a href="{{ route('user-profile.favorite-writers') }}"
                        class="flex flex-col items-center gap-4 rounded-base bg-primary p-2 dark:bg-emerald-600 md:flex-row">
                        <div class="relative rounded-base bg-emerald-600/50 p-2 dark:bg-primary/50">
                            <svg class="h-8 w-8 text-white">
                                <use xlink:href="#notification" />
                            </svg>
                            <span
                                class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-sm font-medium text-white dark:bg-primary md:hidden">
                                6
                            </span>
                        </div>

                        <div class="flex items-center gap-x-2 text-sm font-medium text-white md:text-base">
                            <span class="hidden md:block">{{$user->favoriteWriters()->count()}}</span> نویسندگان محبوب
                        </div>
                    </a>
                </div>
            </div>

            <div class="mb-8">
                <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                    <h3 class="flex items-center gap-x-4 text-lg text-text/90">
                        <span class="h-2 w-2 rounded-full bg-primary"></span>
                        وضعیت سفارش های شما
                    </h3>
                    <a class="btn-primary-nobg text-base" href="{{ route('user-profile.orders') }}">
                        مشاهده همه
                        <span>
                            <svg class="h-5 w-5 lg:h-6 lg:w-6">
                                <use xlink:href="#chevron-left"></use>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-4 md:gap-6 xl:grid-cols-4">
                    
                    <!-- item -->
                    <div
                        class="flex flex-col items-center gap-4 rounded-base bg-primary p-2 dark:bg-emerald-600 md:flex-row">
                        <div class="relative rounded-base bg-emerald-600/50 p-2 dark:bg-primary/50">
                            <svg class="h-10 w-10 text-white">
                                <use xlink:href="#order-delivered" />
                            </svg>
                            <span
                                class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-sm font-medium text-white dark:bg-primary md:hidden">
                                10
                            </span>
                        </div>
                        <div class="flex flex-col gap-y-1">
                            <div class="hidden font-medium text-white md:block">
                                {{$finishedOrders->count()}} سفارش
                            </div>
                            <div class="text-white">تکمیل شده</div>
                        </div>
                    </div>

                    <!-- item -->
                    <div class="flex flex-col items-center gap-4 rounded-base bg-warning p-2 dark:bg-red-400 md:flex-row">
                        <div class="relative rounded-base bg-red-400/50 p-2 /50">
                            <svg class="h-10 w-10 text-white">
                                <use xlink:href="#order-canceled" />
                            </svg>
                            <span
                                class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-red-400 text-sm font-medium text-white md:hidden">
                                3
                            </span>
                        </div>
                        <div class="flex flex-col gap-y-1">
                            <div class="hidden font-medium text-white md:block">
                                {{$canceledOrders->count()}} سفارش
                            </div>
                            <div class="text-white">لغو شده</div>
                        </div>
                    </div>

                    <!-- item -->
                    <div
                        class="flex flex-col items-center gap-4 rounded-base bg-yellow-500 p-2 dark:bg-yellow-600 md:flex-row">
                        <div class="relative rounded-base bg-yellow-600/50 p-2 dark:bg-yellow-500/50">
                            <svg class="h-10 w-10 text-white">
                                <use xlink:href="#order-returned" />
                            </svg>
                            <span
                                class="absolute -right-1 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-yellow-600 text-sm font-medium text-white dark:bg-yellow-500 md:hidden">
                                0
                            </span>
                        </div>
                        <div class="flex flex-col gap-y-1">
                            <div class="hidden font-medium text-white md:block">
                                {{$pendingOrders->count()}} سفارش
                            </div>
                            <div class="text-white">در انتظار پرداخت</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

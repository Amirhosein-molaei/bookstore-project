@extends('app.profile.layouts.master')
@section('title', 'علاقمندی ها')

@section('content')
    <!-- content -->
    @if ($favoriteProducts->count() > 0)
        <div class="col-span-12 lg:col-span-9">
            <div class="rounded-lg bg-muted p-5 shadow-base">
                <div class="mb-16 flex flex-col items-center justify-between gap-y-8 xs:flex-row">
                    <!-- Title -->
                    <h1 class="relative w-fit text-xl font-medium">
                        علاقه‌مندی های شما
                        <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                        </span>
                    </h1>

                    <form action="{{ route('user-profile.product-favorite.empty') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-red w-full px-4 py-2 xs:w-fit" type="submit">
                            حذف همه
                        </button>
                    </form>
                </div>
                <div
                    class="mb-8 grid grid-cols-2 gap-1 gap-y-2 xs:gap-4 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($favoriteProducts as $product)
                        <!-- Product Favorite Card -->
                        <div
                            class="border-gradient group relative rounded-base border p-px before:absolute before:-inset-px before:h-[calc(100%+2px)] before:w-[calc(100%+2px)] before:rounded-base">
                            <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                                <!-- image -->
                                <div class="mb-2 md:mb-5" draggable="false">
                                    <a href="{{ route('product', $product->slug) }}">
                                        <img alt="" class="mx-auto w-32 rounded-lg md:w-auto"
                                            src="{{ asset($product->image) }}" style="height: 278px" />
                                    </a>
                                </div>
                                <!-- title -->
                                <div class="mb-2">
                                    <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base" href="{{ route('product', $product->slug) }}">
                                        {{ $product->title }}
                                    </a>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-medium text-primary xs:text-base">
                                        موجود
                                    </div>
                                    <form action="{{ route('user-profile.product-favorite.remove', $product) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-background text-red-500 transition-all duration-200 hover:bg-warning hover:text-gray-100 dark:text-red-400 hover:dark:bg-red-400 hover:dark:text-black">
                                            <svg class="h-6 w-6">
                                                <use xlink:href="#trash" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                {{$favoriteProducts->links()}}
            </div>
        </div>
    @else
        <div class="col-span-12 lg:col-span-9">
            <div class="rounded-lg bg-muted p-5 shadow-base">
                <div class="mb-16 flex flex-col items-center justify-between gap-y-8 xs:flex-row">
                    <!-- Title -->
                    <h1 class="relative w-fit text-xl font-medium">
                        علاقه‌مندی های شما
                        <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                        </span>
                    </h1>
                </div>
                <!-- empty message -->
                <div class="flex justify-center">
                    <div class="flex flex-col items-center justify-center gap-y-4 text-text/60">
                        <svg class="h-20 w-20">
                            <use xlink:href="#heart-off" />
                        </svg>
                        <p class="md:text-xl">
                            علاقه‌مندی های اخیر شما خالی میباشد
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@extends('app.profile.layouts.master')
@section('title', 'کیف پول')

@section('content')
    <!-- content -->
    <div class="col-span-12 lg:col-span-9">
        <div class="rounded-lg bg-muted p-5 shadow-base">
            <!-- Title -->
            <h1 class="relative mb-16 w-fit text-xl font-medium">
                اطلاعات حساب کاربری شما
                <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
                </span>
            </h1>
            <!-- Content -->
            <div class="grid grid-cols-2 gap-4">
                <!-- full name -->
                <div class="col-span-2 sm:col-span-1">
                    <div class="w-full" type="button" data-modal-target="fullname-modal" data-modal-toggle="fullname-modal">
                        <div class="relative rounded-lg border p-4 hover:border-border/50">
                            <div class="flex justify-between">
                                <div class="flex flex-col items-start gap-y-2">
                                    <div class="text-text/90">میزان موجودی</div>
                                    <div class="mr-2 text-text/60">{{ number_format($wallet->balance) }} تومان</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  deposite   -->
                <div class="col-span-2 sm:col-span-1">
                    <button class="w-full" type="button" data-modal-target="deposite-modal"
                        data-modal-toggle="deposite-modal">
                        <div class="relative rounded-lg border p-4 hover:border-border/50">
                            <div class="flex justify-between">
                                <div class="flex flex-col items-start gap-y-2">
                                    <div class="text-text/90">افزایش موجودی</div>
                                    <div class="mr-2 text-text/60">|</div>
                                </div>
                                <svg class="h-6 w-6 text-primary">
                                    <use xlink:href="#credit" />
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>


                <!-- deposite modal -->
                <div id="deposite-modal" tabindex="-1" aria-hidden="true"
                    class="main-scroll fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
                    <div class="relative max-h-full w-full max-w-md">
                        <div
                            class="divide-y overflow-hidden rounded-lg bg-muted shadow ring-1 ring-gray-100 dark:ring-white/5">
                            <div class="px-4 py-5 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h3 class="md:text-lg">افزایش موجودی</h3>

                                    <button class="" data-modal-hide="deposite-modal" type="button">
                                        <svg class="h-5 w-5">
                                            <use xlink:href="#close"></use>
                                        </svg>

                                        <span class="sr-only">Close Modal</span>
                                    </button>
                                </div>
                            </div>
                            <form action="{{ route('user-profile.wallet.deposit') }}" class="space-y-6 px-4 py-5 sm:p-6" method="post">
                                @csrf
                                <div>
                                    <label for="deposite" class="relative block rounded-lg border shadow-base">
                                        <input type="text" id="amount" name="amount"
                                            class="peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                            placeholder="مبلغ" />

                                        <span
                                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/60 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                            مبلغ
                                        </span>
                                    </label>
                                    <div class="my-2 h-6"></div>
                                </div>
                                <div class="flex items-center justify-end gap-x-4">
                                    <button class="btn-primary w-full px-4 py-2 xs:w-24" type="submit">
                                        پرداخت
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

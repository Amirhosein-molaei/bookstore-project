@extends('app.profile.layouts.master')
@section('title', 'اطلاعات کاربری')

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
                    <button class="w-full" type="button" data-modal-target="fullname-modal" data-modal-toggle="fullname-modal">
                        <div class="relative rounded-lg border p-4 hover:border-border/50">
                            <div class="flex justify-between">
                                <div class="flex flex-col items-start gap-y-2">
                                    <div class="text-text/90">نام و نام خانوادگی</div>
                                    <div class="mr-2 text-text/60">{{ Auth::user()->name }}</div>
                                </div>
                                <svg class="h-6 w-6 text-primary">
                                    <use xlink:href="#edit" />
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>

                <!-- password   -->
                <div class="col-span-2 sm:col-span-1">
                    <button class="w-full" type="button" data-modal-target="password-modal"
                        data-modal-toggle="password-modal">
                        <div class="relative rounded-lg border p-4 hover:border-border/50">
                            <div class="flex justify-between">
                                <div class="flex flex-col items-start gap-y-2">
                                    <div class="text-text/90">کلمه عبور</div>

                                    <div class="mr-2 select-none text-text/60">
                                        <input type="password" value="{{Str::limit(Auth::user()->password, 8) ?? 'ثبت نشده'}}" class="select-none bg-transparent"
                                            disabled />
                                    </div>
                                </div>
                                <svg class="h-6 w-6 text-primary">
                                    <use xlink:href="#edit" />
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Full name modal -->
    <div id="fullname-modal" tabindex="-1" aria-hidden="true"
        class="main-scroll fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <div class="divide-y overflow-hidden rounded-lg bg-muted shadow ring-1 ring-gray-100 dark:ring-white/5">
                <div class="px-4 py-5 sm:px-6">
                    <div class="flex items-center justify-between">
                        <h3 class="md:text-lg">تغییر نام و نام خانوادگی</h3>

                        <button class="" data-modal-hide="fullname-modal" type="button">
                            <svg class="h-5 w-5">
                                <use xlink:href="#close"></use>
                            </svg>

                            <span class="sr-only">Close Modal</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('user-profile.update-name') }}" method="POST" class="space-y-6 px-4 py-5 sm:p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="name" class="relative block rounded-lg border shadow-base">
                                <input type="text" id="name" name="name"
                                    class="peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                    placeholder="نام کاربری" value="{{ Auth::user()->name }}" />

                                <span
                                    class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/60 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                    نام کاربری
                                </span>
                            </label>
                            @error('name')
                                <div class="my-2 h-6 text-red-500 dark:text-red-400">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-x-4">
                        <button class="btn-primary w-full px-4 py-2 xs:w-24" type="submit">
                            ویرایش
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- password modal -->
    <div id="password-modal" tabindex="-1" aria-hidden="true"
        class="main-scroll fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-lg">
            <div class="divide-y overflow-hidden rounded-lg bg-muted shadow ring-1 ring-gray-100 dark:ring-white/5">
                <div class="px-4 py-5 sm:px-6">
                    <div class="flex items-center justify-between">
                        <h3 class="md:text-lg">تغییر کلمه عبور</h3>

                        <button class=" " data-modal-hide="password-modal" type="button">
                            <svg class="h-5 w-5">
                                <use xlink:href="#close"></use>
                            </svg>

                            <span class="sr-only">Close Modal</span>
                        </button>
                    </div>
                </div>
                <div class="space-y-6 px-4 py-5 sm:p-6">
                    <div>
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-4">
                                <div>
                                    <label for="currentPassword" class="relative block rounded-lg border shadow-base">
                                        <input type="password" id="currentPassword" name="current_password"
                                            class="peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                            placeholder="کلمه عبور فعلی" />

                                        <span
                                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/60 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                            کلمه عبور فعلی
                                        </span>
                                    </label>
                                    @error('current_password')
                                        <div class="my-2 h-6 text-red-500 dark:text-red-400">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="password" class="relative block rounded-lg border shadow-base">
                                        <input type="password" id="password" name="password"
                                            class="peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                            placeholder="کلمه عبور جدید" />

                                        <span
                                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/60 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                            کلمه عبور جدید
                                        </span>
                                    </label>
                                    @error('password')
                                        <div class="my-2 h-6 text-red-500 dark:text-red-400">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <div class="mb-4 flex items-center gap-x-2">
                                        <div class="h-[3px] w-full rounded-full bg-background dark:bg-zinc-800"></div>
                                        <div class="h-[3px] w-full rounded-full bg-background dark:bg-zinc-800"></div>
                                        <div class="h-[3px] w-full rounded-full bg-background dark:bg-zinc-800"></div>
                                        <div class="h-[3px] w-full rounded-full bg-background dark:bg-zinc-800"></div>
                                    </div>
                                    <div>
                                        <ul
                                            class="select-none list-disc space-y-2 px-4 text-xs text-slate-500 dark:text-slate-400 md:text-sm">
                                            <li>
                                                <p>حداقل 8 حرف</p>
                                            </li>
                                            <li>
                                                <p>شامل عدد</p>
                                            </li>
                                            <li>
                                                <p>شامل یک حرف بزرگ</p>
                                            </li>
                                            <li>
                                                <p>شامل یک حرف کوچک</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div>
                                    <label for="password_confirmation"
                                        class="relative block rounded-lg border shadow-base">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                            placeholder="تکرار کلمه عبور جدید" />

                                        <span
                                            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/60 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                                            تکرار کلمه عبور جدید
                                        </span>
                                    </label>

                                    @if ($errors->updatePassword->any())
                                        <div class="my-2">
                                            <ul class="space-y-2 text-red-500 dark:text-red-400">
                                                @foreach ($errors->updatePassword->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-x-4">
                                <button class="btn-primary w-full px-4 py-2 xs:w-fit" type="submit">
                                    تغییر کلمه عبور
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

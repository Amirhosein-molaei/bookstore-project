@extends('app.profile.layouts.master')
@section('title', 'تیکت‌ها - صفحه پروفایل کاربر')

@section('content')
    <!-- Main Content -->
    <div class="col-span-12 lg:col-span-9">
        <div class="rounded-lg bg-muted p-5 shadow-base">
            <h1 class="relative mb-16 w-fit text-xl font-medium">
                تیکت‌ها
                <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary"></span>
            </h1>

            <!-- Unreviewed Tickets -->
            <section class="mb-12">
                <h3 class="flex items-center gap-x-4 text-lg text-text/90 mb-6">
                    <span class="h-2 w-2 rounded-full bg-red-500"></span>
                    تیکت‌های بررسی نشده
                </h3>
                <div class="space-y-6">
                    @forelse($unreviewedTickets as $ticket)
                        <div
                            class="rounded-lg border border-gray-200 p-6 shadow-sm bg-white hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-medium text-lg text-gray-800">{{ $ticket->subject }}</h4>
                                <span class="text-sm font-semibold text-red-500 bg-red-50 px-2 py-1 rounded">در
                                    انتظار بررسی</span>
                            </div>
                            <div class="grid grid-cols-1 gap-4 text-sm text-gray-700">

                                <p><span class="font-semibold">متن تیکت:</span> {{ $ticket->body }}</p>
                                <p><span class="font-semibold">دسته تیکت:</span> {{ $ticket->category->name }}
                                </p>

                                <p><span class="font-semibold">نویسنده:</span>
                                    {{ $ticket->user->name ?? 'نامشخص' }}</p>
                                @if ($ticket->file && $ticket->file->file_path)
                                    <p>
                                        <span class="font-semibold">فایل:</span>
                                        <a href="{{ asset($ticket->file->file_path) }}"
                                            class="text-primary hover:underline" target="_blank">دانلود</a>
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">
                                    <span class="font-semibold">تاریخ :</span> {{ jdate($ticket->created_at) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">هیچ تیکت بررسی نشده‌ای وجود ندارد.</p>
                    @endforelse
                </div>
            </section>

            <!-- Reviewed Tickets -->
            <section class="mb-12">
                <h3 class="flex items-center gap-x-4 text-lg text-text/90 mb-6">
                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                    تیکت‌های بررسی شده
                </h3>
                <div class="space-y-6">
                    @forelse($reviewedTickets as $ticket)
                        <div
                            class="rounded-lg border border-gray-200 p-6 shadow-sm bg-white hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-medium text-lg text-gray-800">{{ $ticket->subject }}</h4>
                                <span class="text-sm font-semibold text-green-500 bg-green-50 px-2 py-1 rounded">بررسی
                                    شده</span>
                            </div>
                            <div class="grid grid-cols-1 gap-4 text-sm text-gray-700">
                                <p><span class="font-semibold">متن تیکت:</span> {{ $ticket->body }}</p>
                                <p><span class="font-semibold">دسته تیکت:</span> {{ $ticket->category->name }}
                                </p>

                                <p><span class="font-semibold">نویسنده:</span>
                                    {{ $ticket->user->name ?? 'نامشخص' }}</p>
                                @if ($ticket->file && $ticket->file->file_path)
                                    <p>
                                        <span class="font-semibold">فایل:</span>
                                        <span>{{ basename($ticket->file->file_path) }}</span>
                                        <a href="{{ asset('storage/' . $ticket->file->file_path) }}"
                                            class="text-primary hover:underline" target="_blank">دانلود</a>
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">
                                    <span class="font-semibold">تاریخ :</span> {{ jdate($ticket->created_at) }}
                                </p>
                            </div>

                            <!-- Display Answers if Exists -->
                            @if ($ticket->answers->isNotEmpty())
                                <div class="mt-4 space-y-4">
                                    <p class="font-semibold text-sm text-gray-700">پاسخ‌ها:</p>
                                    @foreach ($ticket->answers as $answer)
                                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                            <p class="text-sm text-gray-700">{{ $answer->body }}</p>
                                            <p class="text-sm text-gray-600 mt-2">
                                                <span class="font-semibold">پاسخ‌دهنده:</span>
                                                {{ $answer->admin ? $answer->admin->user->name : 'نامشخص' }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-2">
                                                <span class="font-semibold">تاریخ پاسخ:</span>
                                                {{ jdate($answer->created_at) }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">هیچ تیکت بررسی شده‌ای وجود ندارد.</p>
                    @endforelse
                </div>
            </section>

            <h1 class="relative mb-16 w-fit text-xl font-medium">
                ثبت تیکت جدید
                <span class="absolute right-0 top-10 h-[3px] w-full rounded-full btn-secondary"></span>
            </h1>

            <form action="{{ route('user-profile.ticket.send') }}" id="ticket-form" class="relative w-full" method="post"
                enctype="multipart/form-data">
                @csrf
                <label for="subject" class="relative block rounded-lg border shadow-base mb-6">
                    <input type="text" id="subject" name="subject" dir="auto"
                        class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0"
                        placeholder="عنوان" value="{{ old('subject') }}">

                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                        عنوان
                    </span>
                    @error('subject')
                        <p class="h-5 text-sm text-red-500 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </label>

                <div class="mb-6">
                    <label for="category_id" class="text-red-5000 mb-2 block text-sm font-medium">
                        موضوع
                    </label>
                    <select id="category_id" name="category_id"
                        class="block w-full rounded-lg border bg-muted p-2.5 text-sm outline-none">
                        <option selected="" disabled="" value="">گیزنه ای را انتخاب کنید</option>
                        @foreach ($ticketCategories as $ticketCategory)
                            <option value="{{ $ticketCategory->id }}" @if ($ticketCategory->id == old('category_id')) selected @endif>
                                {{ $ticketCategory->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="h-5 text-sm text-red-500 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <label for="body" class="relative block rounded-lg border shadow-base mb-6">
                    <textarea type="text" id="body" name="body" rows="4"
                        class="main-scroll peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0">{{ old('body') }}</textarea>

                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/60 transition-all peer-placeholder-shown:top-6 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                        پیام
                    </span>
                    @error('body')
                        <p class="h-5 text-sm text-red-500 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </label>

                <label for="image" class="relative block rounded-lg border shadow-base mb-6 text-right">
                    <input type="file" id="image" name="image" dir="auto"
                        class="peer w-full rounded-lg border-none bg-transparent p-4 text-right placeholder-transparent focus:outline-none focus:ring-0">

                    <span
                        class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
                        تصویر(اختیاری)
                    </span>
                    @error('image')
                        <p class="h-5 text-sm text-red-500 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </label>

                <div class="flex justify-center">
                    <button type="submit" class="btn-secondary w-1/2 px-4 py-3">ثبت</button>
                </div>
            </form>
        </div>
    </div>
@endsection

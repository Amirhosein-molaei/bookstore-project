@extends('app.layouts.master')
@section('title', $blog->title)

@section('content')
    <main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
        <div class="container relative">
            <!-- بخش هدر و ناوبری -->
            <div class="mb-6 hidden md:block">
                <nav aria-label="Breadcrumb" class="w-fit rounded-lg bg-muted px-4 py-4 shadow-base">
                    <ol class="flex flex-wrap items-center justify-center gap-x-2 gap-y-4">
                        <li class="flex items-center gap-x-2">
                            <a href="{{route('app.home')}}" class="text-sm text-text/90 hover: hover:">
                                خانه
                            </a>
                            <span class="text-text/90">
                                <svg class="h-5 w-5"><use xlink:href="#chevron-left"></use></svg>
                            </span>
                        </li>
                        <li class="flex items-center gap-x-2">
                            <a href="{{route('blogs.index')}}" class="text-sm text-text/90 hover: hover:">
                                وبلاگ
                            </a>
                            <span class="text-text/90">
                                <svg class="h-5 w-5"><use xlink:href="#chevron-left"></use></svg>
                            </span>
                        </li>
                        <li>
                            <p class="text-sm text-text/90 hover: hover:">جزئیات وبلاگ</p>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- محتوای اصلی بلاگ -->
            <div class="grid grid-cols-12 grid-rows-[60px_min(500px,_1fr)] gap-4">
                <div class="col-span-12 space-y-4 md:col-span-8 lg:col-span-9">
                    <div class="rounded-lg bg-muted p-3 shadow-base md:p-5">
                        <h1 class="mb-8 font-medium md:text-xl">{{$blog->title}}</h1>

                        <div class="mb-8 flex flex-col items-center justify-between gap-4 xs:flex-row">
                            <!-- اطلاعات نویسنده و تاریخ -->
                        </div>

                        <div class="mb-8">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-full rounded-xl">
                        </div>

                        <div class="leading-loose text-text/90">
                            <p class="mb-6">{{$blog->body}}</p>
                        </div>
                    </div>

                    <!-- بخش نظرات -->
                    <div class="py-6" id="comments">
                        <div class="relative mb-16 w-fit text-xl font-medium">
                            دیدگاه ها
                            <span class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary"></span>
                        </div>

                        <div>
                            <div class="grid grid-cols-12 gap-y-8 md:gap-8">
                                <!-- فرم ثبت نظر جدید -->
                                @if (Auth::check())
                                    <div class="col-span-12 md:col-span-4 lg:col-span-3">
                                        <form action="{{ route('blog.comment.store', $blog) }}" method="post">
                                            @csrf
                                            <div class="grid grid-cols-2 gap-4 md:sticky md:top-32">
                                                <div class="text-lg">ثبت دیدگاه</div>

                                                <div class="col-span-2">
                                                    <label for="comment" class="relative block rounded-lg border shadow-base">
                                                        <textarea type="text" id="comment" name="body" rows="3"
                                                                  class="main-scroll peer w-full rounded-lg border-none bg-transparent px-4 py-3 placeholder-transparent focus:outline-none focus:ring-0"
                                                                  placeholder="متن دیدگاه" required></textarea>
                                                        @error('body')
                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                        @enderror

                                                        <span class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-muted px-2 py-0.5 text-sm text-text/90 transition-all peer-placeholder-shown:top-6 peer-placeholder-shown:text-base peer-focus:top-0 peer-focus:text-sm">
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
                                                <div class="mb-4 text-sm text-text/60">
                                                    برای ثبت دیدگاه ابتدا <a href="{{ route('login') }}" class="text-primary">وارد شوید</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- لیست نظرات -->
                                <div class="order-first col-span-12 mb-10 max-h-[500px] overflow-hidden md:order-last md:col-span-8 lg:col-span-9"
                                     id="commentsContainer">
                                    <div>
                                        <ul class="mb-8 space-y-4 divide-y divide-gray-200 dark:divide-white/10">
                                            @forelse ($blog->comments()->whereNull('parent_id')->get() as $comment)
                                                <li class="space-y-2">
                                                    <div class="mt-4 flex items-center gap-x-4 pb-6">
                                                        <div class="flex items-center gap-x-2">
                                                            <div class="text-sm text-text/60">
                                                                {{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%B %d، %Y') }}
                                                            </div>
                                                            <span class="h-3 w-px rounded-full bg-background dark:bg-muted/10"></span>
                                                            <div class="text-sm text-text/60">{{ $comment->user->name }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="py-2">
                                                        <div class="flex items-center justify-between gap-2">
                                                            <h5 class="mb-4 leading-relaxed xl:text-lg">
                                                                {{ $comment->body }}
                                                            </h5>
                                                            @auth
                                                                <button data-comment-id="{{ $comment->id }}"
                                                                        class="btn-secondary-nobg reply-btn" type="button">
                                                                    پاسخ
                                                                    <svg class="w-5 h-5"><use xlink:href="#chevron-left" /></svg>
                                                                </button>
                                                            @endauth
                                                        </div>

                                                        <div class="flex items-center justify-between gap-x-8">
                                                            @auth
                                                                <div class="text-sm text-text/60">
                                                                    آیا این دیدگاه برایتان مفید بود؟
                                                                </div>
                                                                <div class="flex gap-x-4">
                                                                    <form action="{{ route('blog.comment.like', $comment) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="flex items-center gap-x-2 text-primary transition-all duration-200 hover:text-emerald-400 hover:dark:text-primary">
                                                                            <span class="text-sm">{{ $comment->likes }}</span>
                                                                            <svg class="h-6 w-6"><use xlink:href="#like" /></svg>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ route('blog.comment.dislike', $comment) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="flex items-center gap-x-2 text-red-500 transition-all duration-200 hover:text-red-400 dark:text-red-400 hover:dark:text-red-500">
                                                                            <span class="text-sm">{{ $comment->dislikes }}</span>
                                                                            <svg class="h-6 w-6 fill-red-500"><use xlink:href="#dislike" /></svg>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endauth
                                                        </div>
                                                    </div>

                                                    <!-- پاسخ‌ها -->
                                                    @if ($comment->replies->count() > 0)
                                                        <ul class="pl-6 border-l dark:border-white/10">
                                                            @foreach ($comment->replies as $reply)
                                                                <li class="py-4">
                                                                    <div class="py-4 pr-8 border-r dark:border-white/10">
                                                                        <h5 class="mb-4 leading-relaxed xl:text-lg">
                                                                            {{ $reply->body }}</h5>
                                                                        <div class="mb-6 flex items-center gap-x-4 border-b pb-6">
                                                                            <div class="flex items-center gap-x-2 text-text/60">
                                                                                {{ jdate($reply->created_at) }} -
                                                                                {{ $reply->user->name }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                    <!-- فرم پاسخ -->
                                                    @auth
                                                        <div class="hidden mt-4 reply-form" id="reply-form-{{ $comment->id }}">
                                                            <form action="{{ route('blog.comment.reply', ['blog' => $blog, 'comment' => $comment]) }}" method="post">
                                                                @csrf
                                                                <div class="mb-4">
                                                                    <label for="reply-body-{{ $comment->id }}" class="block mb-2 text-sm font-medium text-text/90">
                                                                        پاسخ شما
                                                                    </label>
                                                                    <textarea id="reply-body-{{ $comment->id }}" name="body" rows="3"
                                                                              class="w-full rounded-lg border border-gray-300 bg-transparent p-3 text-sm text-text/90 focus:border-primary focus:ring-primary"
                                                                              required></textarea>
                                                                </div>
                                                                <button type="submit" class="btn-primary px-4 py-2 text-sm">
                                                                    ارسال پاسخ
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endauth
                                                </li>
                                            @empty
                                                <li class="py-4">
                                                    <div class="py-4 pr-8 border-r dark:border-white/10">
                                                        <h5 class="mb-4 leading-relaxed xl:text-lg">
                                                            دیدگاهی برای این مطلب ثبت نشده است.
                                                        </h5>
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>

                                        <!-- صفحه‌بندی -->
                                        @if($blog->comments()->whereNull('parent_id')->count() > 5)
                                            <div class="mt-4">
                                                {{ $blog->comments()->whereNull('parent_id')->paginate(5)->links() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- دکمه مشاهده بیشتر -->
                        <div class="hidden justify-center md:flex">
                            <button class="btn-secondary-nobg" id="toggleCommentsButton">
                                مشاهده بیشتر
                                <svg class="h-5 w-5"><use xlink:href="#chevron-left" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- نوار کناری -->
                <div class="col-span-4 row-span-2 hidden md:block lg:col-span-3">
                    <div class="sticky top-32 mb-4 overflow-hidden">
                        <!-- مطالب مرتبط -->
                        <div class="mb-8 rounded-lg bg-muted px-2 py-3 shadow-base xl:px-4">
                            <p class="mb-4 text-center text-sm font-medium xl:text-base">مطالب مرتبط</p>
                            <ul class="space-y-8">

                                <li>
                                    <a href="{{route('blogs.index')}}" class="btn-primary py-2">
                                        مشاهده همه
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // مدیریت نمایش بیشتر کامنت‌ها
            const toggleButton = document.getElementById('toggleCommentsButton');
            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    const commentsContainer = document.getElementById('commentsContainer');
                    if (commentsContainer.style.maxHeight) {
                        commentsContainer.style.maxHeight = null;
                        toggleButton.innerHTML = 'مشاهده بیشتر <svg class="h-5 w-5"><use xlink:href="#chevron-left"></use></svg>';
                    } else {
                        commentsContainer.style.maxHeight = 'none';
                        toggleButton.innerHTML = 'بستن <svg class="h-5 w-5"><use xlink:href="#chevron-left"></use></svg>';
                    }
                });
            }

            // مدیریت فرم پاسخ به کامنت‌ها
            document.querySelectorAll('.reply-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const replyForm = document.getElementById(`reply-form-${commentId}`);
                    replyForm.classList.toggle('hidden');
                });
            });
        });
    </script>
@endpush

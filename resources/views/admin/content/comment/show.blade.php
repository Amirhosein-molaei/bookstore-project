@extends('admin.layouts.master')
@section('title', 'اطلاعات نظر')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div class="mb-2">
                <h5>
                    اطلاعات نظر
                </h5>
                <p>نظر نوشته شده برای مدل
                    @if ($comment->commentable_type == 'App\Models\Market\Product')
                        <b>محصول</b>
                    @else
                        <b>بلاگ</b>
                    @endif
                    با نام <b>{{ $comment->commentable->title }}</b>
                </p>
            </div>
        </section>
        <section class="body-content">
            <div>
                <div class="d-flex justify-content-between mt-1">
                    <p class="mb-2">نوشته شده توسط {{ $comment->user->name }} در {{ jdate($comment->created_at) }} ------ امتیاز داده شده : {{$comment->rate != 0 ? $comment->rate : 'امتیاز ثیت نشده'}}</p>
                    @if ($comment->status == 1)
                        <span class="p-2 text-white bg-warning rounded">
                            دیده شده
                        </span>
                    @endif
                    @if ($comment->status == 2)
                        <span class="p-2 text-white bg-success rounded">
                            تایید شده
                        </span>
                    @endif
                </div>
                <div>
                    <h6 class="text-primary">متن نظر</h6>
                    <p>{{ $comment->body }}</p>
                </div>
            </div>

            <div class="mt-4 mr-4">
                <h6 class="mb-2">پاسخ ها ({{ count($comment->answers) }})</h6>
                @forelse ($comment->answers as $answer)
                    <div class="border-top mt-2">
                        <div class="d-flex justify-content-between mt-1">
                            <p class="mt-2">نوشته شده توسط {{ $answer->user->name }} در {{ jdate($answer->created_at) }} ------ امتیاز داده شده : {{$answer->rate != 0 ? $answer->rate : 'امتیاز ثیت نشده'}}
                            </p>
                            @if ($answer->status == 1)
                                <span class="p-2 text-white bg-warning rounded">
                                    دیده شده
                                </span>
                            @endif
                            @if ($answer->status == 2)
                                <span class="p-2 text-white bg-success rounded">
                                    تایید شده
                                </span>
                            @endif
                        </div>
                        <div>
                            <h6 class="text-primary">متن نظر</h6>
                            <p>{{ $answer->body }}</p>
                        </div>
                    </div>

                    {{-- showing each answer's answers (second-answers) --}}

                    @forelse ($answer->answers as $secondAnswer)
                        <div class="mt-2 mr-4 border-top">
                            <div class="d-flex justify-content-between mt-1">
                                <p class="mt-2">نوشته شده توسط {{ $secondAnswer->user->name }} در
                                    {{ jdate($secondAnswer->created_at) }} ------ امتیاز داده شده : {{$secondAnswer->rate != 0 ? $secondAnswer->rate : 'امتیاز ثیت نشده'}}
                                </p>
                                @if ($secondAnswer->status == 1)
                                    <span class="p-2 text-white bg-warning rounded">
                                        دیده شده
                                    </span>
                                @endif
                                @if ($secondAnswer->status == 2)
                                    <span class="p-2 text-white bg-success rounded">
                                        تایید شده
                                    </span>
                                @endif
                            </div>
                            <div>
                                <h6 class="text-primary">متن نظر</h6>
                                <p>{{ $secondAnswer->body }}</p>
                            </div>
                        </div>
                    @empty
                        <p>پاسخی یافت نشد</p>
                    @endforelse
                @empty
                    <p>پاسخی وجود ندارد</p>
                @endforelse

            </div>
        </section>
    </section>
@endsection

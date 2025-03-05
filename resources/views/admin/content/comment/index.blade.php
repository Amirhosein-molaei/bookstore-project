@extends('admin.layouts.master')

@section('title', 'نظرات')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    نظرات
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد نظرات به شما داده می شود
                </p>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">متن نظر</th>
                        <th scope="col">پاسخ برای</th>
                        <th scope="col">امتیاز از 5</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">نظر برای مدل</th>
                        <th scope="col">نام مدل</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ Str::limit($comment->body, 15, '...') }}</td>
                            <td>{{ $comment->parent ? Str::limit($comment->parent->body, 20, '...') : 'نظر اصلی' }}</td>
                            <td>{{ $comment->rate }}</td>
                            <td>
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
                                @if ($comment->status == 3)
                                    <span class="p-2 text-white bg-danger rounded">
                                        رد شده
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($comment->commentable_type == 'App\Models\Market\Product')
                                    محصول
                                @elseif ($comment->commentable_type == 'App\Models\Content\Blog')
                                    بلاگ
                                @endif
                            </td>
                            <td>
                                {{ Str::limit($comment->commentable->title, 20, '...') }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.comment.show', $comment) }}" class="text-primary">
                                            نمایش
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.comment.change-status', $comment) }}" class="p-0 m-0" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if ($comment->status == 1 or $comment->status == 3)
                                                <button type="submit" class="p-2 rounded text-white bg-primary">تایید</button>
                                            @else
                                                <button type="submit" class="p-2 rounded text-white bg-danger">رد تایید</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $comments->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </section>

@endsection

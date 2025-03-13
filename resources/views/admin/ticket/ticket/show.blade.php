@extends('admin.layouts.master')
@section('title', 'اطلاعات تیکت')

@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            اطلاعات تیکت
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.ticket.ticket.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content my-2">
                    <table class="table">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">عنوان</th>
                                <th scope="col">مقدار</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>عنوان</td>
                                <td>{{ $ticket->subject }}</td>
                            </tr>
                            <tr>
                                <td>دسته بندی</td>
                                <td>{{ $ticket->category->name }}</td>
                            </tr>
                            <tr>
                                <td>سوال کننده</td>
                                <td>{{ $ticket->user->name }}</td>
                            </tr>
                            <tr>
                                <td>پاسخ دهنده</td>
                                <td>{{ $ticket->admin->user->name }}</td>
                            </tr>
                            <tr>
                                <td>متن پاسخ</td>
                                <td>{{ $ticket->body }}</td>
                            </tr>
                            <tr>
                                <td>وضعیت</td>
                                <td>{{ $ticket->status ? 'بسته' : 'باز' }}</td>
                            </tr>
                            <tr>
                                <td>ایجاد شده در</td>
                                <td>{{ jdate($ticket->created_at) }}</td>
                            </tr>
                            <tr>
                                <td>آخرین ویرایش در</td>
                                <td>{{ jdate($ticket->updated_at) }}</td>
                            </tr>
                            <tr>
                                <td>فایل</td>
                                <td>
                                    @if ($ticket->file)
                                        <a href="{{ asset($ticket->file->file_path) }}">دانلود</a>
                                    @else
                                        ندارد
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>تغییر وضعیت</td>
                                <td>
                                    <form action="{{ route('admin.ticket.ticket.change-status', $ticket) }}"
                                        method="post">
                                        @csrf
                                        @if ($ticket->status)
                                            <button type="submit" class="btn btn-danger">باز کردن</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">بستن</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div class="mt-4 mr-4">
                        <h6 class="mb-2 text-info">پاسخ ها ({{ count($ticket->answers) }})</h6>
                        @forelse ($ticket->answers as $answer)
                            <div class="border-top mt-2">
                                <p class="mt-2 text-primary">نوشته شده توسط {{ $answer->admin->user->name }} در
                                    {{ jdate($answer->created_at) }}</p>
                                <div>
                                    <h6>متن پاسخ</h6>
                                    <p>{{ $answer->body }}</p>
                                </div>
                            </div>
                        @empty
                            <p>پاسخی وجود ندارد</p>
                        @endforelse
                    </div>
                    <hr>

                    <h6 class="mx-2">ثبت پاسخ جدید برای این تیکت</h6>
                    @if ($ticket->status == 0)
                        <form action="{{ route('admin.ticket.ticket.store') }}" method="post" class="row g-3">
                            @csrf

                            <div class="col-12 mb-2">
                                <label for="body" class="form-label">متن پاسخ</label>
                                <textarea name="body" id="body" cols="100" rows="7" class="form-control">{{ old('body') }}</textarea>
                                @error('body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <input type="hidden" name="parent_id"
                                value="{{ $ticket->parent ? $ticket->parent->id : $ticket->id }}">

                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-success">ثبت</button>
                            </div>
                        </form>
                    @else
                        <p>این تیکت بسته شده و امکان ثبت پاسخ جدید ندارد</p>
                    @endif
                </section>
            </section>
        </section>
    </section>
@endsection

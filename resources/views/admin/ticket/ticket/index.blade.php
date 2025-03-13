@extends('admin.layouts.master')
@section('title', 'تیکت')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    تیکت ها
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد تیکت ها به شما داده می شود
                </p>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">متن تیکت</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">دسته بندی</th>
                        <th scope="col">پاسخ دهنده</th>
                        <th scope="col">سوال کننده</th>
                        <th scope="col">پاسخ</th>
                        <th scope="col">فایل</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ Str::limit($ticket->subject, 15, '...') }}</td>
                            <td>{{ Str::limit($ticket->body, 15, '...') }}</td>
                            <td>
                                @if ($ticket->status == 0)
                                    باز
                                @else
                                    بسته
                                @endif
                            </td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>{{ $ticket->admin->user->name }}</td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>
                                @if ($ticket->parent_id)
                                    {{ $ticket->parent->subject }}
                                @else
                                    تیکت اصلی
                                @endif
                            </td>
                            <td>
                                @if ($ticket->file)
                                    <a href="{{ asset($ticket->file->file_path) }}">دانلود</a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.ticket.ticket.destroy', $ticket) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.ticket.ticket.edit', $ticket) }}" class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.ticket.ticket.show', $ticket) }}" class="text-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="mx-2">
                                        <form action="{{ route('admin.ticket.ticket.change-status', $ticket) }}" method="post">
                                            @csrf
                                            @if ($ticket->status)
                                                <button type="submit" class="btn btn-danger">باز کردن</button>
                                            @else
                                                <button type="submit" class="btn btn-primary">بستن</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </section>
    </section>
@endsection

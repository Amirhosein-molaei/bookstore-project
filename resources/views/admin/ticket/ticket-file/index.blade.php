@extends('admin.layouts.master')
@section('title', 'فایل های تیکت')

@section('content')
<section class="main-body-container">
    <section class="main-body-container-header d-flex justify-content-between align-items-center">
        <div>
            <h5>
                فایل های تیکت
            </h5>
            <p>
                در این بخش اطلاعاتی در مورد فایل تیکت به شما داده می شود
            </p>
        </div>
        <!-- <div>
            <a href="{{ route('admin.ticket.ticket-file.create') }}" class="btn btn-success">ساخت</a>
        </div> -->
    </section>
    <section class="body-content">

        <table class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">مسیر فایل</th>
                    <th scope="col">سایز فایل</th>
                    <th scope="col">نوع فایل</th>
                    <th scope="col">کاربر فرستنده</th>
                    <th scope="col">تیکت مربوطه</th>
                    <th scope="col">تنظیمات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $ticket->file_path }}</td>
                    <td>{{ $ticket->file_size }}</td>
                    <td>{{ $ticket->file_type }}</td>
                    <td> {{ $ticket->user->name }}</td>
                    <td>{{ Str::limit($ticket->ticket->body, 20, '...') }}</td>
                    <td>
                        <div class="d-flex">
                            <div class="mx-2">
                                <form action="{{ route('admin.ticket.ticket-file.destroy', $ticket) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="mx-2">
                                <a href="{{ route('admin.ticket.ticket-file.download', $ticket) }}"
                                    class="text-warning">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $tickets->links('pagination::bootstrap-4') }}
        </div>

    </section>
</section>
@endsection
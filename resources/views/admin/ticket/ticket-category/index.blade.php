@extends('admin.layouts.master')

@section('title', 'دسته بندی تیکت')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    تیکت
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد دسته بندی تیکت ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{route('admin.ticket.ticket-category.create')}}" class="btn btn-success">ایجاد</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($tickets as $key => $ticket)
                    <tr>
                        <td>{{ $tickets->firstItem() + $key }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td class="{{ $ticket->getRawOriginal('status') ? 'text-success' : 'text-danger' }}">
                            {{ $ticket->status }}
                        </td>
                        <td>
                            <div class="d-flex">
                                <div class="mx-2">
                                    <form action="{{ route('admin.ticket.ticket-category.destroy', ['ticket_category' => $ticket->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('admin.ticket.ticket-category.edit', ['ticket_category' => $ticket->id]) }}" class="text-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">دسته بندی وجود ندارد</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{  $tickets->links()  }}
            </div>
        </section>
    </section>

@endsection


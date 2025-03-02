@extends('admin.layouts.master')

@section('title', 'سوالات متداول')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    سوالات متداول
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد سوالات متداول به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.faq.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">سوال</th>
                        <th scope="col">پاسخ</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>

                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.faq.destroy', $faq) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.faq.edit', $faq) }}" class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
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

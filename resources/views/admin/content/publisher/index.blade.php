@extends('admin.layouts.master')

@section('title', '  ناشران')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                ناشران
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد ناشران  به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.publisher.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">اسلاگ</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publishers as $publisher)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $publisher->name }}</td>
                            <td>{{ $publisher->slug }}</td>
                            
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{route('admin.content.publisher.destroy',$publisher)}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button  type="submit"
                                            class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{route('admin.content.publisher.edit',$publisher)}}"
                                            class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="d-flex justify-content-center">
            {{ $publishers->links('pagination::bootstrap-4') }}
        </div>

        </section>
    </section>

@endsection

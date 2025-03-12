@extends('admin.layouts.master')

@section('title', 'فایل های محصول')

@section('content')

<section class="main-body-container">
    <section class="main-body-container-header d-flex justify-content-between align-items-center">
        <div>
            <h5>
                فایل های محصول : {{ $product->title }}
            </h5>
            <p>
                در این بخش اطلاعاتی در مورد فایل ها به شما داده می شود
            </p>
        </div>
        <div>
            <a href="{{ route('admin.market.product-file.create', $product) }}" class="btn btn-success">ساخت</a>
            <a href="{{ route('admin.market.product.index') }}" class="btn btn-warning mr-4">بازگشت</a>
        </div>
    </section>
    <section class="body-content">

        <table class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام</th>
                    <th scope="col">حجم (کیلوبایت)</th>
                    <th scope="col">فرمت</th>
                    <th scope="col">تنظیمات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $file->name }}</td>
                    <td>{{ number_format(round($file->size / 1024)) }}</td>
                    <td>{{ $file->type }}</td>
                    
                    <td>
                        <div class="d-flex">
                            <div class="mx-2">
                                <form action="{{route('admin.market.product-file.destroy',[$product, $file])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="mx-2">
                                <a href="{{route('admin.market.product-file.edit',[$product, $file])}}"
                                    class="text-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                            <div class="mx-2">
                                <form action="{{route('admin.market.product-file.download',$file)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        دانلود
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $files->links('pagination::bootstrap-4') }}
        </div>

    </section>
</section>

@endsection
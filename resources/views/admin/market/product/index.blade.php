@extends('admin.layouts.master')

@section('title', 'محصولات')

@section('content')

<section class="main-body-container">
    <section class="main-body-container-header d-flex justify-content-between align-items-center">
        <div>
            <h5>
                محصولات
            </h5>
            <p>
                در این بخش اطلاعاتی در مورد محصولات به شما داده می شود
            </p>
        </div>
        <div>
            <a href="{{ route('admin.market.product.create') }}" class="btn btn-success">ساخت</a>
        </div>
    </section>
    <section class="body-content">

        <table class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">اسلاگ</th>
                    <th scope="col">تصویر</th>
                    <th scope="col">قیمت</th>
                    <th scope="col">قیمت تخفیفی</th>
                    <th scope="col">نوع</th>
                    <th scope="col">دسته بندی</th>
                    <th scope="col">نویسنده</th>
                    <th scope="col">تنظیمات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ Str::limit($product->title, 20, '...') }}</td>
                    <td>{{ Str::limit($product->description, 20, '...') }}</td>
                    <td>{{ Str::limit($product->slug, 20, '...') }}</td>
                    <td>
                        <img src="{{ asset($product->image) }}" alt="">
                    </td>

                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ $product->discounted_price }}</td>
                    <td>
                        @if ($product->type == 0)
                            متنی
                        @else
                            صوتی
                        @endif
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->writer->name }}</td>
                    
                    <td>
                        <div class="d-flex">
                            <div class="mx-2">
                                <form action="{{route('admin.market.product.destroy',$product)}}" method="post" class="m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="mx-2">
                                <a href="{{route('admin.market.product.edit',$product)}}"
                                    class="text-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                            <div class="mx-2">
                                <a href="{{route('admin.market.product.show',$product)}}"
                                    class="text-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </section>
</section>

@endsection
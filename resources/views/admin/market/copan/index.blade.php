@extends('admin.layouts.master')

@section('title', ' تخفیف ها')

@section('content')

<section class="main-body-container">
    <section class="main-body-container-header d-flex justify-content-between align-items-center">
        <div>
            <h5>
                تخفیف ها
            </h5>
            <p>
                در این بخش اطلاعاتی در مورد تخفیف ها به شما داده می شود
            </p>
        </div>
        <div>
            <a href="{{ route('admin.market.copan.create') }}" class="btn btn-success">ساخت</a>
        </div>
    </section>
    <section class="body-content">

        <table class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"> کد </th>
                    <th scope="col"> میزان</th>
                    <th scope="col">نوع</th>
                    <th scope="col">سقف </th>
                    <th scope="col">تاریخ شروع </th>
                    <th scope="col">تاریخ پایان </th>
                    <th scope="col">وضعیت </th>
                    <th scope="col">تنظیمات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($copans as $copan)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $copan->code }}</td>
                    <td>{{number_format( $copan->amount) }}
                        @if($copan->amount_type == 1)
                        تومان
                        @else
                        درصد
                        @endif
                    </td>
                    <td>@if($copan->amount_type == 1)
                        مقداری
                        @else
                        درصدی
                        @endif</td>
                    <td>
                        @if($copan->amount_type == 0)
                        {{ number_format($copan->discount_ceiling) }} تومان
                        @else
                        0
                        @endif
                    </td>

                    <td>{{ $copan->start_date }}</td>
                    <td>{{ $copan->end_date }}</td>
                    <td>@if($copan->status == 1)
                        فعال
                        @else
                        غیرفعال
                        @endif
                    </td>

                    <td>
                        <div class="d-flex">
                            <div class="mx-2">
                                <form action="{{route('admin.market.copan.destroy',$copan)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="mx-2">
                                <a href="{{route('admin.market.copan.edit',$copan)}}"
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
            {{ $copans->links('pagination::bootstrap-4') }}
        </div>
    </section>
</section>

@endsection
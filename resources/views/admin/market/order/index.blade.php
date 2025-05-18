@extends('admin.layouts.master')
@use('Morilog\Jalali\Jalalian')
@section('title', ' تاریخچه سفارشات')

@section('content')

<section class="main-body-container">
    <section class="main-body-container-header d-flex justify-content-between align-items-center">
        <div>
            <h5>
                تاریخچه سفارشات
            </h5>
            <p>
                در این بخش اطلاعاتی در مورد تاریخچه سفارشات به شما داده می شود
            </p>
        </div>
    </section>
    <section class="body-content">

        <table class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">مبلغ</th>
                    <th scope="col">نوع پرداخت</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">کد تخفیف</th>
                    <th scope="col">مجموع تخفیف</th>
                    <th scope="col">توسط </th>
                    <th scope="col">تاریخ سفارش</th>
                    <th scope="col">تاریخ دانلود</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ number_format($order->order_final_amount) }}</td>
                    <td>
                        {{ $order->payment_type == 0 ? 'کیف پول' : 'آنلاین' }}
                    </td>
                    <td>
                        @if ($order->order_status == 0)
                            <span class="text-warning">منتظر پرداخت</span>
                        @elseif ($order->order_status == 1)
                            <span class="text-success">پرداخت شده</span>
                        @else
                            <span class="text-danger">لغو شده</span>
                        @endif
                    </td>
                    <td>
                        {{ $order->copan_id != null ? $order->copan->code : 'ندارد' }}
                    </td>
                    <td>
                        {{ number_format($order->order_total_discount) }}
                    </td>
                    <td>
                        {{ $order->user->name }}
                    </td>
                    <td>
                        {{ Jalalian::forge($order->created_at)->format('%B %d، %Y')}}
                    </td>
                    <td class="{{$order->downloaded ? 'text-success' : 'text-warning'}}">
                        {{ $order->downloaded ? Jalalian::forge($order->downloaded_at)->format('%B %d، %Y') : 'دانلود نشده' }}
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </section>
</section>

@endsection
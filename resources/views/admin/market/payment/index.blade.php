@extends('admin.layouts.master')

@section('title', 'پرداخت ها ')

@section('content')
@php
use Morilog\Jalali\Jalalian;
@endphp

<section class="main-body-container">
    <section class="main-body-container-header d-flex justify-content-between align-items-center">
        <div>
            <h5>
                پرداخت ها
            </h5>
            <p>
                در این بخش اطلاعاتی در مورد پرداخت ها به شما داده می شود
            </p>
        </div>

    </section>
    <section class="body-content">

        <table class="table">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">مبلغ</th>
                    <th scope="col">واریز کننده</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">نوع</th>
                    <th scope="col">درگاه</th>
                    <th scope="col">ای دی پرداخت</th>
                    <th scope="col">کد پیگیری</th>
                    <th scope="col">تاریخ تراکنش</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ number_format($payment->amount) }}</td>
                    <td>{{ $payment->user->mobile }}</td>
                    <td>
                        @if ($payment->status == 0)
                        در انتظار پرداخت
                        @elseif ($payment->status == 1)
                        پرداخت شده
                        @else
                        پرداخت نشده
                        @endif
                    </td>
                    <td>{{ $payment->type == 1 ? 'آنلاین' : 'کیف پول' }}</td>
                    <td>{{ $payment->gateway ? $payment->gateway : ' ----' }}</td>
                    <td>{{ $payment->transaction_id ? $payment->transaction_id :'----' }}</td>
                    <td>{{ $payment->tracking_code ? $payment->tracking_code : '----'  }}</td>
                    <td>{{ jdate($payment->created_at) }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $payments->links('pagination::bootstrap-4') }}
        </div>


    </section>
</section>
@endsection
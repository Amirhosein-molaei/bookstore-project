@extends('admin.layouts.master')

@section('title', ' تخفیف ها')

@section('content')
@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection



<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header d-flex justify-content-between align-items-center">
                <div>
                    <h5>
                        ویرایش کد تخفیف
                    </h5>

                </div>
                <div>
                    <a href="{{ route('admin.market.copan.index') }}" class="btn btn-warning">بازگشت</a>
                </div>
            </section>
            <section class="body-content">

                <form class="row g-3" action="{{ route('admin.market.copan.update',$copan) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 mb-2">
                        <label for="code" class="form-label">کد</label>
                        <input type="text" name="code" class="form-control" id="code"
                            value="{{ old('code',$copan->code) }}">
                        @error('code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="amount" class="form-label">میزان تخفیف </label>
                        <input type="number" name="amount" class="form-control" id="amount"
                            value="{{ old('amount',$copan->amount) }}">
                        @error('amount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="amount_type" class="form-label"> نوع</label>
                        <select class="form-control" name="amount_type" id="amount_type">
                            <option value="1" @if ($copan->amount_type  == 1) selected @endif>مقداری</option>
                            <option value="0" @if ($copan->amount_type  == 0) selected @endif>درصدی</option>

                        </select>
                        @error('amount_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="discount_ceiling" class="form-label">سقف تخفیف </label>
                        <input type="number" name="discount_ceiling" class="form-control" id="discount_ceiling"
                            value="{{ old('discount_ceiling',$copan->discount_ceiling) }}">
                        @error('discount_ceiling')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ شروع</label>
                                <input type="text" name="start_date" id="start_date"
                                    class="form-control form-control-sm d-none">
                                <input type="text" id="start_date_view" value="{{$copan->start_date}}" class="form-control form-control-sm">
                            </div>
                            @error('start_date')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ اتمام</label>
                                <input type="text" name="end_date" id="end_date"
                                    class="form-control form-control-sm d-none">
                                <input type="text" id="end_date_view" value="{{$copan->end_date}}" class="form-control form-control-sm">
                            </div>
                            @error('end_date')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>
                    <div class="col-md-6 mb-2">
                        <label for="status" class="form-label"> وضعیت</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" @if ($copan->status == 1) selected @endif>فعال</option>
                            <option value="0" @if ($copan->status == 0) selected @endif>غیرفعال</option>

                        </select>
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    





                    <div class="col-12">
                        <button type="submit" class="btn btn-success">ثبت</button>
                    </div>
                </form>

            </section>
        </section>
    </section>
</section>




@endsection

@section('scripts')
    @parent
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#start_date'
                }),
                $('#end_date_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#end_date'
                })
        });
    </script>

@endsection
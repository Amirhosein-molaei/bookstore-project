@extends('admin.layouts.master')

@section('title', ' ساخت فایل')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت فایل
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.market.product-file.index', $product) }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">

                    <form class="row g-3" action="{{ route('admin.market.product-file.store', $product) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 mb-2">
                            <label for="file" class="form-label">فایل</label>
                            <br>
                            <input type="file" name="file" class="form-file-control" id="file"
                                value="{{ old('file') }}">
                            @error('file')
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

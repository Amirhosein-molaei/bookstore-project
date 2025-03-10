@extends('admin.layouts.master')

@section('title', 'تگ ها')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت بنر
                        </h5>

                    </div>
                    <div>
                        <a href="{{route('admin.content.banners.index')}}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="image" accept="image/*">
                            <button type="submit">آپلود عکس</button>
                        </div>
                        <button type="submit" class="btn btn-primary">ایجاد</button>
                    </form>
            </section>
          </section>
         </section>





@endsection

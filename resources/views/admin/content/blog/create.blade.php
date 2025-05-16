@extends('admin.layouts.master')

@section('title', 'ساخت بلاگ')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت بلاگ
                        </h5>

                    </div>
                    <div>
                        <a href="{{ route('admin.content.blog.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form class="row g-3" action="{{ route('admin.content.blog.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ old('title') }}" placeholder="عنوان">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="body">متن اصلی</label>
                                <textarea name="body" id="body" class="form-control" rows="5" required placeholder="متن اصلی">
                                {{ old('body') }}
                            </textarea>
                                @error('body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label>تصویر</label>
                            <input type="file" class="form-control-file" name="image">
                            @error('image')
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





    @endsection

@extends('admin.layouts.master')

@section('title', 'ویرایش بلاگ')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش بلاگ
                        </h5>
                    </div>
                    <div>
                        <a href="{{route('admin.content.blog.index')}}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">

                    <form class="row g-3" action="{{route('admin.content.blog.update',$blog)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" class="form-control" id="title"
                                   value="{{ old('title', $blog->title) }}">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="body">توضیحات</label>
                                <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body', $blog->body) }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">ثبت</button>
                        </div>

                    </form>
                </section>
            </section>
        </section>





@endsection

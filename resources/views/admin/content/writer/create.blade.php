@extends('admin.layouts.master')
@section('title', 'ایجاد نویسنده')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ایجاد نویسنده
                        </h5>
                    </div>
                    <div>
                        <a href="{{ route('admin.content.writer.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.content.writer.store') }}" method="post" class="row g-3">
                        @csrf

                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">نام</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="نام" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="nationality" class="form-label">ملیت</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" placeholder="ملیت" value="{{ old('nationality') }}">
                            @error('nationality')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="age" class="form-label">سن</label>
                            <input type="text" name="age" id="age" class="form-control" placeholder="سن" value="{{ old('age') }}">
                            @error('age')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="role" class="form-label">نوع</label>
                            <select class="form-control" name="role" id="role">
                                <option class="form-control" value="0">نویسنده</option>
                                <option class="form-control" value="1">مترجم</option>
                                <option class="form-control" value="2">نویسنده و مترجم</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea class="form-control" cols="100" rows="10" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-success">ثبت</button>
                        </div>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
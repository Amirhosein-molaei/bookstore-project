@extends('admin.layouts.master')

@section('title', 'تگ ها')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت تگ
                        </h5>

                    </div>
                    <div>
                        <a href="{{route('admin.content.tags.index')}}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form class="row g-3" action="{{route('admin.content.tags.store')}}" method="POST">
                        @csrf
                        <div class="col-12 mb-2">
                            <label for="name" class="form-label">تگ</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="status" class="form-label">تگ</label>
                            <select class="flex-grow"  id="status" name="status">
                                <option value="1" selected>فعال</option>
                                <option value="0">غیرفعال</option>
                            </select>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">ثبت</button>
                        </div>
                    </div>
                    </form>
            </section>
          </section>
         </section>





@endsection

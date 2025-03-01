@extends('admin.layouts.master')

@section('title', ' تنظیمات ')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                             تنظیمات
                        </h5>

                    </div>
                    <div>
                        <a href="{{ route('admin.setting.') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">

                    <form class="row g-3" action="{{ route('admin.setting.set.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="
                                @if($setting) {{old('title',$setting->
                                title) }}
                                @else
                                {{old('title')}}
                                @endif
                                  ">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-2">
                            <label for="description" class="form-label">توضیحات</label>
                            <input type="text" name="description" class="form-control" id="description"
                                value="
                                @if($setting) {{old('description',$setting->
                                description) }}
                                @else
                                {{old('description')}}
                                @endif
                                  ">
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="keywords" class="form-label">کلمات کلیدی</label>
                            <input type="text" name="keywords" class="form-control" id="keywords"
                                value="
                                 {{old('keywords',$setting->keywords ?? '' ) }}">
                            @error('keywords')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <label>لوگو</label>
                            <input type="file" class="form-control-file" name="logo">
                            @if($setting)
                            <img src="{{asset($setting->logo)}}" alt="" width="50" height="50">
                            @endif
                            @error('logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <label>آیکون</label>
                            <input type="file" class="form-control-file" name="icon">
                            @if($setting)
                            <img src="{{asset($setting->icon)}}" alt="" width="50" height="50">
                            @endif
                            @error('icon')
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

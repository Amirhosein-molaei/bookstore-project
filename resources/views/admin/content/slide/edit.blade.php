@extends('admin.layouts.master')

@section('title', ' اسلایدها ')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش اسلاید
                        </h5>

                    </div>
                    <div>
                        <a href="{{ route('admin.content.slide.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">

                    <form class="row g-3" action="{{ route('admin.content.slide.update',$slide) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-2">
                            <img src="{{asset($slide->image)}}" width="100" height="100" alt="">
                            <label>تصویر</label>
                            <input type="file" class="form-control-file" name="image">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="url" class="form-label">آدرس</label>
                            <input type="text" name="url" class="form-control" id="url"
                                value="{{ old('url',$slide->url) }}">
                            @error('url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    

                        <div class="col-md-12 mb-2">
                            <label for="position" class="form-label">موقعیت</label>
                            <select class="form-control" name="position" id="position">
                               
                                    <option value="{{ 1 }}" @if($slide->position == 1) selected @endif> سمت راست</option>
                                    <option value="{{ 2 }}" @if($slide->position == 2) selected @endif> سمت چپ بالا</option>
                                    <option value="{{ 3 }}" @if($slide->position == 3) selected @endif> سمت چپ پایین</option>

                               
                            </select>
                            @error('position')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="status" class="form-label">وضعیت :</label>
                            <select class="form-control" name="status" id="status">
                               
                                    <option value="{{ 0 }}" @if($slide->status == 0) selected @endif>  غیرفعال</option>
                                    <option value="{{ 1 }}" @if($slide->status == 1) selected @endif> فعال  </option>

                               
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

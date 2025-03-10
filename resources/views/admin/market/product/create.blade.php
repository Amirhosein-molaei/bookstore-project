@extends('admin.layouts.master')

@section('title', 'ساخت محصول')

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
@endsection
@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ساخت محصول
                        </h5>

                    </div>
                    <div>
                        <a href="{{ route('admin.market.product.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">

                    <form class="row g-3" action="{{ route('admin.market.product.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 mb-2">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ old('title') }}" placeholder="عنوان" required>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="image">تصویر جلد</label>
                            <br>
                            <input type="file" name="image" id="image" class="form-file-control" required>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="price" class="form-label">قیمت</label>
                            <input type="number" name="price" class="form-control" id="price"
                                value="{{ old('price') }}" placeholder="قیمت" required>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="type" class="form-label">نوع</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="0" @if (old('type') == 0) selected @endif>متنی</option>
                                <option value="1" @if (old('type') == 1) selected @endif>صوتی</option>
                            </select>
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="page_count" class="form-label">تعداد صفحات</label>
                            <input type="number" name="page_count" class="form-control" id="page_count"
                                value="{{ old('page_count') }}" placeholder="تعداد صفحات">
                            @error('page_count')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="release_year" class="form-label">سال انتشار</label>
                            <input type="number" name="release_year" class="form-control" id="release_year"
                                value="{{ old('release_year') }}" placeholder="سال انتشار" required>
                            @error('release_year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="publisher_id" class="form-label">ناشر</label>
                            <select name="publisher_id" id="publisher_id" class="form-control" required>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" @if (old('publisher_id') == $publisher->id) selected @endif>
                                        {{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="writer_id" class="form-label">نویسنده</label>
                            <select name="writer_id" id="writer_id" class="form-control" required>
                                @foreach ($writers as $writer)
                                    <option value="{{ $writer->id }}" @if (old('writer_id') == $writer->id) selected @endif>
                                        {{ $writer->name }}</option>
                                @endforeach
                            </select>
                            @error('writer_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="tags" class="form-label">برچسب ها</label>
                            <select name="tags[]" id="tags" class="tags_multiple_select form-control" required
                                multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tags')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="marketable" class="form-label">وضعیت فروش</label>
                            <select name="marketable" id="marketable" class="form-control" required>
                                <option value="0" @if (old('marketable') == 0) selected @endif>فعال</option>
                                <option value="1" @if (old('marketable') == 1) selected @endif>غیر فعال</option>
                            </select>
                            @error('marketable')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="product_category_id" class="form-label">دسته بندی</label>
                            <select name="product_category_id" id="product_category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <optgroup label="{{ $category->name }}" class="font-bold">
                                        @if ($category->subCategories->count() == 0)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                            @foreach ($category->subCategories as $subCategories)
                                                <option value="{{ $subCategories->id }}"
                                                    @if (old('product_category_id') == $subCategories->id) selected @endif>
                                                    {{ $subCategories->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('product_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="discount_percentage" class="form-label">درصد تخفیف (اختیاری)</label>
                            <input type="number" name="discount_percentage" class="form-control"
                                id="discount_percentage" value="{{ old('discount_percentage') }}"
                                placeholder="درصد تخفیف از صد">
                            @error('discount_percentage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ اتمام تخفیف</label>
                                <input type="number" name="discount_expires_at" id="discount_expires_at"
                                    class="form-control d-none">
                                <input type="text" id="discount_expires_at_view" class="form-control">
                            </div>
                            @error('discount_expires_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script>
        CKEDITOR.replace('description');

        $(document).ready(function() {
            $('#discount_expires_at_view').persianDatepicker({
                'observer': true,
                format: 'YYYY/MM/DD',
                altField: '#discount_expires_at'
            });

            $('.tags_multiple_select').select2();
        });
    </script>
@endsection

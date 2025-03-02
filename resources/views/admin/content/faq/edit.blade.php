@extends('admin.layouts.master')

@section('title', 'سوالات متداول')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش سوال
                        </h5>

                    </div>
                    <div>
                        <a href="{{ route('admin.content.faq.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">

                    <form class="row g-3" action="{{ route('admin.content.faq.update', $faq) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="col-12 mb-2">
                            <label for="question" class="form-label">سوال</label>
                            <input type="text" name="question" class="form-control" id="question"
                                value="{{ old('question', $faq->question) }}">
                            @error('question')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-12 mb-2">
                            <label for="answer" class="form-label">پاسخ</label>
                            <input type="text" name="answer" class="form-control" id="answer"
                                value="{{ old('answer', $faq->answer) }}">
                            @error('answer')
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

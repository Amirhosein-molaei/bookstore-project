@extends('admin.layouts.master')
@section('title', 'ویرایش تیکت')
    
@section('content')
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش تیکت 
                        </h5>
                        <p><i class="fa fa-info-circle text-warning"></i> توجه داشته باشید فقط مسئول پاسخگویی به تیکت را میتوانید ویرایش کنید</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.ticket.ticket.index') }}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form action="{{ route('admin.ticket.ticket.update', $ticket) }}" method="post" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 mb-2">
                            <label for="subject" class="form-label">عنوان</label>
                            <input readonly type="text" id="subject" class="form-control" value="{{ $ticket->subject }}">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="category_id" class="form-label">دسته بندی</label>
                            <input readonly type="text" id="category_id" class="form-control" value="{{ $ticket->category->name }}">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="body" class="form-label">متن تیکت</label>
                            <textarea readonly id="body" cols="100" rows="10" class="form-control">{{ $ticket->body }}</textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="user" class="form-label">سوال کننده</label>
                            <input readonly type="text" id="user" class="form-control" value="{{ $ticket->user->name }}">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="reference_id" class="form-label">پاسخ دهنده</label>
                            <select name="reference_id" id="reference_id" class="form-control col-12">
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->user->name }}</option>
                                @endforeach
                            </select>
                            @error('reference_id')
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
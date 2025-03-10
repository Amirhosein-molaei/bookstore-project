@extends('admin.layouts.master')

@section('title', 'ویرایش دسته بندی تیکت')

@section('content')



    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            ویرایش دسته بندی تیکت
                        </h5>

                    </div>
                    <div>
                        <a href="{{route('admin.ticket.ticket-category.index')}}" class="btn btn-warning">بازگشت</a>
                    </div>
                </section>
                <section class="body-content">
                    <form class="row g-3" action="{{ route('admin.ticket.ticket-category.update', ['ticket_category' => $ticket_category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-2">
                            <label for="name" class="form-label">نام</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $ticket_category->name) }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <label for="status" class="form-label">وضعیت</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" @if($ticket_category->status == 1) selected @endif>فعال</option>
                                <option value="0" @if($ticket_category->status == 0) selected @endif>غیرفعال</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">ویرایش</button>
                        </div>
                    </form>
                </section>
            </section>
        </section>

@endsection

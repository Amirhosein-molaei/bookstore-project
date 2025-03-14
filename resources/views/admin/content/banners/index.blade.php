@extends('admin.layouts.master')

@section('title', 'بنر ها')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>بنر</h5>
                <p>در این بخش اطلاعاتی در مورد بنر ها به شما داده می شود</p>
            </div>
            <div>
                <a href="{{ route('admin.content.banners.create') }}" class="btn btn-success">ایجاد</a>
            </div>
        </section>
        <section class="body-content">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table">
                <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">تصویر</th>
                    <th scope="col">وضعیت انتخاب</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $key => $banner)
                    <tr>
                        <td>{{ $banners->firstItem() + $key }}</td>
                        <td>
                            <img src="{{asset($banner->image) }}" width="80px">
                        </td>
                        <td>
                            <form action="{{ route('admin.content.banners.select', $banner->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn {{ $banner->is_selected ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $banner->is_selected ? 'انتخاب شده' : 'انتخاب' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex">
                                <div class="mx-2">
                                    <form action="{{ route('admin.content.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $banners->links() }}
            </div>
        </section>
    </section>
@endsection

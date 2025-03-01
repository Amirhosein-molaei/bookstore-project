@extends('admin.layouts.master')

@section('title', '   تنظیمات')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                تنظیمات 
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد   تنظیمات به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.setting.set') }}" class="btn btn-success">ساخت / ویرایش</a>
            </div>
        </section>
        <section class="body-content">
            @if($setting)
            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> عنوان </th>
                        <th scope="col"> توضیحات </th>
                        <th scope="col">کلمات کلیدی</th>
                        <th scope="col">لوگو </th>
                        <th scope="col">آیکون </th>


                    </tr>
                </thead>
                <tbody>
                  
                        <tr>
                            <th>1</th>
                            <td>{{ $setting->title }}</td>
                            <td>{{ Str::limit($setting->description,50) }}</td>
                            <td>{{ Str::limit($setting->keywords,50) }}</td>

                            <td>
                               <img src="{{asset($setting->logo)}}" alt="" width="100" height="100">
                            </td>
                            <td>
                               <img src="{{asset($setting->icon)}}" alt="" width="100" height="100">
                            </td>
                        </tr>
                   


                </tbody>
            </table>
            @else
            <p>تنظیماتی یافت نشد</p>
            @endif

        </section>
    </section>

@endsection

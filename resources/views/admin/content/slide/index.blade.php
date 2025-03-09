@extends('admin.layouts.master')

@section('title', '  اسلایدها ')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                       اسلاید 
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد   اسلایدها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.slide.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> عکس </th>
                        <th scope="col"> آدرس </th>
                        <th scope="col"> موقعیت </th>
                        <th scope="col"> وضعیت </th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slides as $slide)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td><img width="100" height="70" src="{{asset($slide->image)}}" alt=""></td>
                            <td>{{ $slide->url }}</td>
                            
                            <td>@if($slide->position == 1)
                                سمت راست
                                @elseif($slide->position == 2)
                                سمت چپ بالا
                                @elseif($slide->position == 3)
                                سمت چپ پایین
                                @endif
                            </td>
                            <td>
                                @if($slide->status == 1)
                                 فعال و در دسترس
                                @elseif($slide->status == 0)
                                  غیر فعال
                                @endif
                            </td>

                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{route('admin.content.slide.destroy',$slide)}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button  type="submit"
                                            class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{route('admin.content.slide.edit',$slide)}}"
                                            class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
          

        </section>
    </section>

@endsection

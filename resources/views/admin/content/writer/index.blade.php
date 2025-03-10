@extends('admin.layouts.master')
@section('title', 'نویسندگان')

@section('content')
    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    نویسندگان
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد نویسندگان به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{ route('admin.content.writer.create') }}" class="btn btn-success">ساخت</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">ملیت</th>
                        <th scope="col">سال تولد</th>
                        <th scope="col">سال رحلت</th>
                        <th scope="col">سال رحلت</th>
                        <th scope="col">نوع</th>
                        <th scope="col">بیوگرافی</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($writers as $writer)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $writer->name }}</td>
                            <td>{{ $writer->nationality }}</td>
                            <td>{{ $writer->birth_year }}</td>
                            <td>{{ $writer->death_year ?? 'در قید حیات' }}</td>
                            <td>
                                @if ($writer->role == 0)
                                نویسنده
                                @endif
                                @if ($writer->role == 1)
                                مترجم
                                @endif
                                @if ($writer->role == 2)
                                نویسنده و مترجم
                                @endif
                            </td>
                            <td>{{ Str::limit($writer->description, 20, '...') }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.content.writer.destroy', $writer) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('admin.content.writer.edit', $writer) }}"
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
            <div class="d-flex justify-content-center">
                {{  $writers->links()  }}
            </div>

        </section>
    </section>
@endsection

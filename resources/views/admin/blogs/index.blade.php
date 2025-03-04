@extends('admin.layouts.master')

@section('title', ' مدیریت بلاگ ها')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    بلاگ
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد بلاگ ها به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{route('admin.blogs.blogs.create')}}" class="btn btn-success">ایجاد</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">متن</th>
                        <th scope="col">بازدید</th>
                        <th scope="col">تاریخ ایجاد</th>
                        <th scope="col">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($blogs as $key => $blog)

                    <tr>
                        <td>{{ $blogs->firstItem() + $key }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->body }}</td>
                        <td>
                            <p class="text-muted">
                                <i class="fas fa-eye"></i> تعداد بازدید: {{ $blog->view_count }}
                            </p>
                        </td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>

                        <td>
                            <div class="d-flex">
                                <div class="mx-2">
                                    <form action="{{ route('admin.blogs.blogs.destroy', ['blog' => $blog->id])  }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('admin.blogs.blogs.edit', ['blog' => $blog->id])  }}" class="text-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">بلاگ وجود ندارد</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{  $blogs->links()  }}
            </div>
        </section>
    </section>

@endsection


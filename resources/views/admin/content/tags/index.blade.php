@extends('admin.layouts.master')

@section('title', 'سوالات متداول')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    تگ
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد تگ به شما داده می شود
                </p>
            </div>
            <div>
                <a href="{{route('admin.content.tags.create')}}" class="btn btn-success">ایجاد</a>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">سوال</th>
                        <th scope="col">پاسخ</th>
                        <th scope="col">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($tags as $key => $tag)
                    <tr>
                        <td>{{ $tags->firstItem() + $key }}</td>
                        <td>{{ $tag->name }}</td>
                        <td class="{{ $tag->getRawOriginal('status') ? 'text-success' : 'text-danger' }}">
                            {{ $tag->status }}
                        </td>
                        <td>
                            <div class="d-flex">
                                <div class="mx-2">
                                    <form action="{{ route('admin.content.tags.destroy', ['tag' => $tag->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="mx-2">
                                    <a href="{{ route('admin.content.tags.edit', ['tag' => $tag->id]) }}" class="text-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">تگ وجود ندارد</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{  $tags->links()  }}
            </div>
        </section>
    </section>

@endsection


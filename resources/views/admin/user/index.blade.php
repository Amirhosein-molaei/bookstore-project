@extends('admin.layouts.master')

@section('title', 'کاربران')

@section('content')

    <section class="main-body-container">
        <section class="main-body-container-header d-flex justify-content-between align-items-center">
            <div>
                <h5>
                    کاربران
                </h5>
                <p>
                    در این بخش اطلاعاتی در مورد کاربران به شما داده می شود
                </p>
            </div>
        </section>
        <section class="body-content">

            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">ایمیل</th>
                        <th scope="col">موبایل</th>
                        <th scope="col">وضعیت حساب کاربری</th>
                        <th scope="col">دسترسی ها</th>
                        <th scope="col">تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>
                                @if ($user->activation)
                                    فعال
                                @else
                                    غیرفعال
                                @endif
                            </td>
                            <td>
                                @if ($user->is_admin)
                                    <span class="bg-success p-2 text-white text-center rounded ml-3">ادمین</span>
                                @else
                                <span class="bg-secondary p-2 text-white text-center rounded ml-3">کاربری عادی</span>
                                @endif
                                @if ($user->ticketAdmin)
                                    <span class="bg-warning p-2 text-center rounded">تیکت-ادمین</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <form action="{{ route('admin.user.change-access', $user) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="text-white bg-danger rounded">
                                                تغییر دسترسی
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        @if ($user->is_admin)
                                            <form action="{{ route('admin.user.change-ticket-admin', $user) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @if ($user->ticketAdmin)
                                                    <button type="submit" class="text-white bg-danger rounded">
                                                        حذف تیکت-ادمین
                                                    </button>
                                                @else
                                                    <button type="submit" class="text-white bg-success rounded">
                                                        افزودن تیکت-ادمین
                                                    </button>
                                                @endif
                                            </form>
                                        @endif
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

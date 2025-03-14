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
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">ایمیل</th>
                        <th scope="col">موبایل</th>
                        <th scope="col">وضعیت حساب</th>
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
                                @if ($user->activated)
                                    فعال
                                @else
                                    غیرفعال
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($user->is_superAdmin)
                                    <span class="bg-success p-1 text-white text-center rounded ml-1">سوپر ادمین</span>
                                @elseif ($user->is_admin)
                                    <span class="bg-primary p-1 text-white text-center rounded ml-1">ادمین</span>
                                @else
                                    <span class="text-secondary">کاربری عادی</span>
                                @endif
                                @if ($user->ticketAdmin)
                                    <span class="bg-warning p-1 text-center rounded">تیکت-ادمین</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex">
                                    @if (!$user->is_superAdmin)
                                        <div class="mx-2">
                                            <form action="{{ route('admin.user.admin-access', $user) }}" method="POST"
                                                class="d-inline m-0 p-0">
                                                @csrf
                                                <button type="submit"
                                                    class="text-white rounded{{ $user->is_admin ? ' bg-danger' : ' bg-success' }}">
                                                    ادمین
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="mx-2">
                                        <form action="{{ route('admin.user.super-admin-access', $user) }}" method="POST"
                                            class="d-inline m-0 p-0">
                                            @csrf
                                            <button type="submit"
                                                class="text-white rounded{{ $user->is_superAdmin ? ' bg-danger' : ' bg-success' }}">
                                                سوپر ادمین
                                            </button>
                                        </form>
                                    </div>
                                    @if ($user->is_admin or $user->is_superAdmin)
                                        <div class="mx-2">
                                            <form action="{{ route('admin.user.change-ticket-admin', $user) }}"
                                                method="POST" class="d-inline m-0 p-0">
                                                @csrf
                                                <button type="submit"
                                                    class="text-white rounded{{ $user->ticketAdmin ? ' bg-danger' : ' bg-success' }}">
                                                    تیکت-ادمین
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </section>
    </section>

@endsection

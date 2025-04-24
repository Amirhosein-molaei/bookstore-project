@extends('app.layouts.master')
@section('title', 'نویسنده های مورد علاقه - صفحه پروفایل کاربر')

@section('content')

<main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">
  <div class="container">
    <div class="grid grid-cols-12 gap-4">
      <!-- sidebar -->
      <div class="col-span-12 lg:col-span-3">
        <!-- Desktop sidebar -->
        <div
          class="sticky top-32 hidden w-full overflow-hidden rounded-lg bg-muted shadow-base lg:block">
          <div
            dir="ltr"
            class="max-h-[calc(90vh_-_100px)] overflow-y-auto p-4 xl:p-6">
            <div dir="rtl">
              <!-- Head -->
              <div
                class="mb-2 flex items-center justify-between border-b pb-6 dark:border-white/10">
                <div class="flex items-center gap-x-4">
                  <div>
                    <img
                      src="./assets/images/user.png"
                      class="h-12 w-12 rounded-full"
                      alt="" />
                  </div>
                  <div class="flex flex-col">
                    <div class="line-clamp-1">تایماز اکبری</div>
                    <div class="line-clamp-1 text-text/90">
                      09000000000
                    </div>
                  </div>
                </div>
                <a href="./profile-edit.html">
                  <svg class="h-6 w-6 text-primary">
                    <use xlink:href="#edit" />
                  </svg>
                </a>
              </div>
              <ul class="space-y-1">
                <li>
                  <a
                    href="./profile-dashboard.html"
                    class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#home" />
                      </svg>
                      <div>پیشخوان</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    href="./profile-orders.html"
                    class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#order" />
                      </svg>
                      <div>سفارش ها</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    href="./profile-favorite.html"
                    class="profile-menu profile-menu-active flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#heart" />
                      </svg>
                      <div>علاقه‌مندی ها</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    href="./profile-recent.html"
                    class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#recent" />
                      </svg>
                      <div>بازدید های اخیر</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    href="./profile-notification.html"
                    class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#notification" />
                      </svg>
                      <div>پیام ها</div>
                    </div>
                    <div
                      class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary text-sm font-bold text-white dark:bg-emerald-600">
                      10
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    href="./profile-address.html"
                    class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#address" />
                      </svg>
                      <div>آدرس ها</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    href="./profile-edit.html"
                    class="profile-menu flex items-center justify-between rounded-lg px-2 py-4 xl:px-4">
                    <div class="flex items-center gap-x-4">
                      <svg class="h-6 w-6">
                        <use xlink:href="#user-setting" />
                      </svg>
                      <div>اطلاعات حساب کاربری</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a
                    class="flex items-center justify-between rounded-lg p-4 text-red-500 hover:bg-warning/10 dark:text-red-400 dark:hover:bg-red-400/10"
                    href="#">
                    <div class="flex items-center gap-x-2">
                      <svg class="h-6 w-6">
                        <use xlink:href="#exit"></use>
                      </svg>
                      <span> خروج </span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Mobile menu -->
        <div class="rounded-lg bg-muted p-6 shadow-base lg:hidden">
          <div class="flex items-center justify-center">
            <div
              class="flex flex-col items-center justify-center gap-y-4">
              <div class="relative">
                <img
                  src="./assets/images/user.png"
                  class="h-20 w-20 only:rounded-full"
                  alt="" />
                <a
                  href="./profile-edit.html"
                  class="absolute -right-2 -top-2 rounded-full bg-primary p-2 text-sm text-white dark:bg-emerald-600">
                  <svg class="h-5 w-5">
                    <use xlink:href="#edit" />
                  </svg>
                </a>
              </div>
              <div>
                <p class="line-clamp-1">تایماز اکبری</p>
                <p class="text-text/60">09000000000</p>
              </div>
              <div>
                <button
                  class="btn-primary px-4 py-2"
                  aria-controls="profile-menu-drawer-navigation"
                  data-drawer-show="profile-menu-drawer-navigation"
                  data-drawer-placement="bottom"
                  data-drawer-target="profile-menu-drawer-navigation"
                  type="button">
                  <svg class="h-6 w-6 text-white">
                    <use xlink:href="#menu" />
                  </svg>
                  منوی پنل کاربری
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- content -->
      <div class="col-span-12 lg:col-span-9">
        <div class="rounded-lg bg-muted p-5 shadow-base">
          <div
            class="mb-16 flex flex-col items-center justify-between gap-y-8 xs:flex-row">
            <!-- Title -->
            <h1 class="relative w-fit text-xl font-medium">
              نویسنده های مورد علاقه شما
              <span
                class="absolute right-0 top-10 h-[3px] w-full rounded-full bg-primary">
              </span>
            </h1>
            <form action="{{ route('writers.favorite.destroy-all') }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn-red w-full px-4 py-2 xs:w-fit" type="submit">
                حذف همه
              </button>
            </form>
          </div>
          @if($favoriteWriters->isEmpty())
          <p>نویسنده مورد علاقه ای وجود  ندارد   .</p>
          @endif
          <div
            class="mb-8 grid grid-cols-2 gap-1 gap-y-2 xs:gap-4 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <!-- Product Favorite Card -->
            @if ($favoriteWriters)


            @foreach ($favoriteWriters as $favoriteWriter)
            <div id="writer-{{ $favoriteWriter->id }}" class="border-gradient group relative rounded-base border p-px">
              <div class="relative rounded-xl bg-muted p-2 shadow-base md:p-5">
                <!-- تصویر نویسنده -->
                @if($favoriteWriter->avatar)
                <div class="mb-2 md:mb-5" draggable="false">
                  <a href="{{ route('writers.details', $favoriteWriter->id) }}">
                    <img alt="" class="mx-auto w-32 rounded-lg md:w-auto" src="{{ $favoriteWriter->avatar }}" />
                  </a>
                </div>
                @endif
                <!-- نام نویسنده -->
                <div class="mb-2">
                  <a class="line-clamp-2 h-10 text-sm md:h-12 md:text-base" href="{{ route('writers.details', $favoriteWriter->id) }}">
                    {{ $favoriteWriter->name }}
                  </a>
                </div>
                <div class="flex items-center justify-between">


                  <!-- فرم حذف نویسنده -->
                  <form action="{{ route('writers.favorite.destroy', $favoriteWriter) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-full bg-background text-red-500 transition-all duration-200 hover:bg-warning hover:text-gray-100 dark:text-red-400 hover:dark:bg-red-400 hover:dark:text-black">
                      <svg class="h-6 w-6">
                        <use xlink:href="#trash" />
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>
            @endforeach

            @endif
          </div>
          <!-- Pagination -->
          <div
            class="flex items-center justify-center gap-x-4 md:justify-end">
            <!-- Previous page-->
            <a
              class="pagination-button flex items-center justify-center"
              href="#">
              <svg class="h-6 w-6">
                <use xlink:href="#chevron-right"></use>
              </svg>
            </a>

            <!-- Pages -->
            <div class="flex items-center gap-x-2">
              <a
                class="pagination-button pagination-button-active"
                href="#">
                1
              </a>
              <p class="text-sm text-text/60">...</p>

              <a class="pagination-button" href="#"> 3 </a>
              <a class="pagination-button" href="#"> 4 </a>

              <p class="text-sm text-text/60">...</p>

              <a class="pagination-button" href="#"> 10 </a>
            </div>
            <!-- Next page-->
            <a
              class="flex h-8 w-8 items-center justify-center rounded-full bg-muted transition-all duration-200 hover:bg-primary hover:text-white hover:dark:bg-emerald-600"
              href="#">
              <svg class="h-6 w-6">
                <use xlink:href="#chevron-left"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
@section('scripts')
@parent
@if (session('swal-success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'موفقیت',
    text: @json(session('swal-success')),
  });
</script>
@endif

@if (session('swal-error'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'خطا',
    text: @json(session('swal-error')),
  });
</script>
@endif
@endsection
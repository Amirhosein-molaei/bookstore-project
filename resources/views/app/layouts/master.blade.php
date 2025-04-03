<!doctype html>
<html dir="rtl" lang="fa">

<head>
    @include('app.layouts.head-tag')
</head>

<body>
    @include('app.layouts.partials.icons')

    <div class="flex min-h-screen flex-col">

        @include('app.layouts.partials.header')

        <main class="flex-grow bg-background pb-14">

            <div class="flex justify-center w-3/4 mx-auto mb-4">
                @if (session('success'))
                    <button class="btn-indigo px-4 py-4">
                        {{ session('success') }}
                        <svg class="h-5 w-5">
                            <use xlink:href="#check"></use>
                          </svg>
                    </button>
                @endif
            </div>

            <div class="flex justify-center w-3/4 mx-auto mb-4">
                @if (session('error'))
                    <button class="btn-rose px-4 py-4">
                        {{ session('error') }}
                        <svg class="h-5 w-5">
                            <use xlink:href="#check"></use>
                          </svg>
                    </button>
                @endif
            </div>

            @yield('content')
        </main>

        @include('app.layouts.partials.footer')
    </div>
    @include('app.layouts.scripts')

    @include('alerts.sweetalert.error')
    @include('alerts.sweetalert.success')


</body>
<script>
    // تابع برای حذف دکمه
    function removeButton() {
        const successButton = document.querySelector('.btn-indigo');
        const errorButton = document.querySelector('.btn-rose');

        if (successButton) {
            successButton.remove();
        }
        
        if (errorButton) {
            errorButton.remove();
        }
    }

    // حذف خودکار دکمه پس از 5 ثانیه
    setTimeout(() => {
        removeButton();
    }, 5000);
</script>

</html>

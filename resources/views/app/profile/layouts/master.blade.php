<!doctype html>
<html dir="rtl" lang="fa">

<head>
    @include('app.layouts.head-tag')
</head>

<body>
    @include('app.layouts.partials.icons')

    <div class="flex min-h-screen flex-col">

        @include('app.layouts.partials.header')

        <main class="flex-grow bg-background pb-14 pt-36 xs:pt-36">

            <div class="flex justify-center w-3/4 mx-auto mb-4">
                @if (session('success'))
                    <button class="btn-indigo px-4 py-4" id="success_msg">
                        {{ session('success') }}
                        <svg class="h-5 w-5">
                            <use xlink:href="#close" onclick="removeButton()"></use>
                        </svg>
                    </button>
                @endif
            </div>

            <div class="flex justify-center w-3/4 mx-auto mb-4">
                @if (session('error'))
                    <button class="btn-rose px-4 py-4" id="error_msg">
                        {{ session('error') }}
                        <svg class="h-5 w-5">
                            <use xlink:href="#close" onclick="removeButton()"></use>
                        </svg>
                    </button>
                @endif
            </div>

            <div class="container">
                <div class="grid grid-cols-12 gap-4">
                    <!-- sidebar -->
                    <div class="col-span-12 lg:col-span-3">
                        @include('app.profile.layouts.partials.desktop-sidebar')
                    </div>

                    @yield('content')
                </div>
            </div>
        </main>

        @include('app.profile.layouts.partials.mobile-sidebar')

        @include('app.layouts.partials.footer')
    </div>
    @include('app.layouts.scripts')


</body>
<script>
    // تابع برای حذف دکمه
    function removeButton() {
        const successButton = document.getElementById('success_msg');
        const errorButton = document.getElementById('error_msg');

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

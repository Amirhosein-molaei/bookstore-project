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
            @yield('content')
        </main>

        @include('app.layouts.partials.footer')
    </div>
    @include('app.layouts.scripts')

    @include('alerts.sweetalert.error')
    @include('alerts.sweetalert.success')
  

</body>

</html>
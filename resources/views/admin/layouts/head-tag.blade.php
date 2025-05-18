<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.layouts.styles')
<link rel="icon" type="image/png" href="{{ asset($setting->icon) }}">
<title>
    @yield('title', 'عنوان صفحه')
</title>
  <!-- افزودن Chart.js از طریق CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

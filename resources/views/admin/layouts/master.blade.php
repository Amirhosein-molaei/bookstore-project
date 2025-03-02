<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head-tag')
<<<<<<< HEAD
=======

   
>>>>>>> menu-management
</head>

<body dir="rtl">


<<<<<<< HEAD
    @include('admin.layouts.partials.header')

    <section class="body-container">

        @include('admin.layouts.partials.sidebar')


        <section id="main-body" class="main-body">

            @yield('content')
=======
    
    @include('admin.layouts.partials.header')


    <section class="body-container">
        
        @include('admin.layouts.partials.sidebar')




        <section id="main-body" class="main-body">

         @yield('content')
       



>>>>>>> menu-management

        </section>
    </section>


<<<<<<< HEAD
    @include('admin.layouts.scripts')

    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.error')
</body>

</html>
=======





@include('admin.layouts.scripts')

@include('alerts.sweetalert.error')
@include('alerts.sweetalert.success')

</body>

</html>
>>>>>>> menu-management

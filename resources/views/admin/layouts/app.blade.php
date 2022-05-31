<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>@yield('title', 'Abir-Ecommerce') - Abir's E-Commerce</title>
    <!-- Vendors Style-->
    @include('admin.layouts.partial.styles')
    @yield('styles')
</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
    <div class="wrapper">

        @include('admin.layouts.partial.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.layouts.partial.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->
        @include('admin.layouts.partial.footer')

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->
    <!-- Vendor JS -->
    @include('admin.layouts.partial.scripts')
    @yield('scripts')
</body>

</html>

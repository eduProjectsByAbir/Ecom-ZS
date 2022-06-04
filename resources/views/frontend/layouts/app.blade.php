<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title', 'Abir-Ecommerce') - Abir's E-Commerce</title>

    @include('frontend.layouts.partials.styles')
    @yield('styles')
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.layouts.partials.header')


    <!-- ============================================== HEADER : END ============================================== -->

    @yield('content')

<!-- /.container -->
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.layouts.partials.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->
@include('frontend.layouts.partials.scripts')
@yield('scripts')
</body>

</html>

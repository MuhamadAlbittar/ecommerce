<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Ecom Admin  Bootstrap 5 Template" />
	<meta property="og:title" content="Ecom Admin  Bootstrap 5 Template" />
	<meta property="og:description" content="Ecom  Admin  Bootstrap 5 Template" />
	<meta property="og:image" content="#" />
	<meta name="format-detection" content="telephone=no">
    <title>User List | MetroX Admin</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/icons/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/icons/fontawesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/icons/fontawesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
     <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="d-flex">

        <!--**********************************
            Sidebar start
        ***********************************-->
            @include('admin.partials.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <div class="content-wrapper">
            @include('admin.partials.header')

            <div class="main-content">
                <div class="extra-header"></div>

                {{-- @include('admin/partials/extra-header') --}}

                @yield('content')
           </div>

@include('admin.partials.screpts')

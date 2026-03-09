<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="{{ asset('adminPanal/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminPanal/icons/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminPanal/icons/fontawesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminPanal/icons/fontawesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminPanal/css/style.css') }}" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 d-flex flex-lg-row">

            @include('layouts.sidebar')
            <div class="content-wrapper ">
            @include('layouts.navigation')

                <div class="main-content">
                    @yield('content')
                </div>



        @include('layouts.scripts')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Midad Store</title>

    <link href="{{ asset('adminPanal/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminPanal/icons/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminPanal/icons/fontawesome/css/solid.min.css') }}" rel="stylesheet">

    <style>
        .product-card img {
            height: 220px;
            object-fit: cover;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 22px;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: red;
            color: white;
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 50%;
        }
        body {
        background-color: #f4f6f6; /* خلفية ناعمة وحلوة */
        }
        .product-card img {
            height: 250px;
            object-fit: cover;
        }
        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: #f9f9f9;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }

        .product-card img {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>

<body >

<nav class="navbar navbar-expand-lg" style="background-color: #266663;">
    <div class="container">

        {{-- Logo on the left --}}
        <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('store.index') }}">
            <img src="{{ asset('adminPanal/images/logo.png') }}" 
                alt="logo" 
                style="height: 40px; width:auto; margin-right: 10px; background:white; padding:5px; border-radius:6px;">
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#storeNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="storeNav">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">contact us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('products.create') }}">Add a product</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('store.index') }}">products</a>
                </li>

            </ul>

            {{-- Cart Icon --}}
            <div class="position-relative">
                <a href="{{ route('cart.index') }}" class="text-white fs-4 position-relative">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-badge">{{ session('cart_count', 0) }}</span>
                </a>
            </div>

        </div>
    </div>
</nav>

<div class="container py-5">
    @yield('content')
</div>

<script src="{{ asset('adminPanal/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
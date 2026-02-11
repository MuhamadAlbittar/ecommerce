@extends('layouts.app')

@section('content')

<style>
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        background: #fff;
        transition: 0.3s;
    }

    .product-card:hover {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .product-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
    }

    .cart-icon {
        position: fixed;
        top: 20px;
        left: 20px;
        background: #3490dc;
        color: #fff;
        padding: 12px 18px;
        border-radius: 50px;
        cursor: pointer;
        z-index: 999;
    }

    .cart-box {
        position: fixed;
        top: 80px;
        left: 20px;
        width: 300px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        display: none;
        z-index: 999;
    }
</style>

{{-- أيقونة السلة --}}
<div class="cart-icon" onclick="toggleCart()">
    🛒 السلة (<span id="cart-count">{{ count(session('cart', [])) }}</span>)
</div>

{{-- صندوق السلة --}}
<div class="cart-box" id="cart-box">
    <h4>السلة</h4>
    <hr>

    @if(session('cart') && count(session('cart')) > 0)
        @foreach(session('cart') as $item)
            <div class="d-flex justify-content-between mb-2">
                <span>{{ $item['name'] }} × {{ $item['qty'] }}</span>
                <span>{{ $item['price'] }} ل.س</span>
            </div>
        @endforeach

        <hr>
        <strong>المجموع: {{ array_sum(array_column(session('cart'), 'price')) }} ل.س</strong>
        <br><br>
        <a href="{{ route('checkout') }}" class="btn btn-success btn-block">إتمام الطلب</a>
    @else
        <p>السلة فارغة</p>
    @endif
</div>

{{-- عرض المنتجات --}}
<div class="container">
    <h2 class="mb-4">البضائع المعروضة</h2>

    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('uploads/' . $product->image) }}" alt="">

                <h5 class="mt-2">{{ $product->name }}</h5>

                <p class="text-muted">التاجر: {{ $product->vendor->name }}</p>

                <p>السعر: <strong>{{ $product->price }} ل.س</strong></p>

                <p>الكمية المتوفرة: {{ $product->quantity }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-block">إضافة إلى السلة</button>
                </form>
            </div>
        @endforeach
    </div>
</div>

<script>
    function toggleCart() {
        let box = document.getElementById('cart-box');
        box.style.display = box.style.display === 'block' ? 'none' : 'block';
    }
</script>

@endsection
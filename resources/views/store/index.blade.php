@extends('store.layout')

@section('content')

<h2 class="text-center mb-5" style="font-size: 32px; font-weight: 600; color:#333;">
    our products
</h2>

<div class="row">

    @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">

                <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top" alt="">

                <div class="card-body text-center">

                    <h5 class="card-title" style="font-size: 18px; font-weight: 500; color:#333;">
                        {{ $product->name }}
                    </h5>

                    <p class="text-muted mb-2" style="font-size: 16px; font-weight: 600; color:#333;">
                        ${{ $product->sale_price ?? $product->price }}
                    </p>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="btn w-100"
                                style="background-color: #266663; color: white; border:none; border-radius:6px; font-size:16px; font-weight:500;">
                            Add to the cart
                        </button>
                    </form>

                </div>
            </div>
        </div>
    @endforeach

</div>

@endsection
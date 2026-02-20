@extends('store.layout')

@section('content')

<h2 class="mb-4">Shopping Cart</h2>

@if(count($cart) == 0)
    <div class="alert alert-info">Your cart is empty</div>
@else

<table class="table table-bordered">
    <thead>
        <tr>
            <th>image</th>
            <th>name</th>
            <th>qty</th>
            <th>price</th>
            <th>total</th>
            <th>remove</th>
        </tr>
    </thead>

    <tbody>
        @foreach($cart as $id => $item)
            <tr>
                <td><img src="{{ asset('uploads/products/' . $item['image']) }}" width="60"></td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>${{ $item['price'] * $item['qty'] }}</td>
                <td>
                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">X</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Total: ${{ $total }}</h4>

<a href="{{ route('cart.clear') }}" class="btn btn-warning mt-3">Clear cart</a>

@endif

@endsection
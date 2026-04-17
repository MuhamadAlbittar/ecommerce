@extends('layouts.app')
@section('content')

<div class="main-content">
    <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
        <div class="container">
            <div class="card shadow-sm border-0 border-radius-12" id="invoice-section">
                <div class="card-body p-4">
                    <div class="invoice mt-5">

                        <div class="invoice-box">

                            {{-- HEADER --}}
                            <div class="invoice-header d-flex justify-content-between">
                                <a class="pt-2 d-inline-block bg-success-color p-2" href="#">
                                    <img src="/assets/images/logo.png" alt="logo">
                                </a>

                                <div class="float-right">
                                    <h3 class="mb-0 invoice-no">Invoice #{{ $order->id }}</h3>
                                    <span class="d-block invoice-date">
                                        Date: {{ $order->created_at->format('d M, Y') }}
                                    </span>
                                </div>
                            </div>

                            {{-- BODY --}}
                            <div class="invoice-body">

                                <div class="row mb-4 d-flex">

                                    {{-- FROM --}}
                                    <div class="col-sm-6 invoice-adds">
                                        <h5 class="mb-2">From:</h5>
                                        <address>
                                            <strong>CYCLE Store</strong><br>
                                            Aleppo, Syria<br>
                                            Phone: +963 999 999 999<br>
                                            Email: support@cycle.com
                                        </address>
                                    </div>

                                    {{-- TO --}}
                                    <div class="col-sm-6 text-right d-flex justify-content-end invoice-adds">
                                        <div>
                                            <h5 class="mb-2">To:</h5>
                                            <address>
                                                <strong>{{ $order->user->name }}</strong><br>
                                                {{ $order->user->address ?? 'No address provided' }}<br>
                                                Phone: {{ $order->user->phone ?? 'N/A' }}<br>
                                                Email: {{ $order->user->email }}
                                            </address>
                                        </div>
                                    </div>

                                </div>

                                {{-- ITEMS TABLE --}}
                                <div class="table-responsive-sm">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->price_at_time }}</td>
                                                    <td>{{ $item->price_at_time * $item->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- TOTALS --}}
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-5"></div>

                                        <div class="col-lg-4 col-sm-5 ms-auto">
                                            @php
                                                $subtotal = $order->orderItems->sum(fn($i) => $i->price_at_time * $i->quantity);
                                                $tax = $subtotal * 0.10;
                                                $total = $subtotal + $tax;
                                            @endphp
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><strong class="text-dark">Subtotal</strong></td>
                                                        <td>{{ $subtotal }}</td>{{-- $order->subtotal --}}
                                                    </tr>

                                                    <tr>
                                                        <td><strong class="text-dark">Tax</strong></td>
                                                        <td>{{ $tax }}</td>{{-- $order->tax --}}
                                                    </tr>

                                                    <tr>
                                                        <td><strong class="text-dark">Total</strong></td>
                                                        <td><strong class="text-dark">{{ $total }}</strong></td>{{-- $order->total_price --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            {{-- FOOTER --}}
                            <div class="invoice-footer">
                                <p class="mb-0">Notice: This invoice was generated automatically.</p>
                            </div>

                        </div>

                        {{-- BUTTONS --}}
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="javascript:void(0)" class="btn text-primary border-color hover-bg-primary me-2" id="printInvoice">
                                    <i class="fa-solid fa-print"></i> Print
                                </a>

                                <button type="submit" class="btn custom-bg-primary text-white btn-hover">
                                    <i class="fa-solid fa-download"></i> Download
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

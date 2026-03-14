@extends('store.layouts.app')

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb_area">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Track Order</li>
        </ol>
    </div>
</div>

<div class="checkout_area bg-white pt-5 pb-5">
    <div class="container">

        {{-- Search Form --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Track Your Order</h3>
                    <p class="text-muted">Enter your order number to see the latest status</p>
                </div>
                <form method="GET" action="{{ route('orders.track') }}">
                    <div class="input-group input-group-lg shadow-sm">
                        <span class="input-group-text bg-dark text-white border-dark">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="number" name="order_id"
                               class="form-control border-dark"
                               placeholder="Enter Order ID (e.g. 1042)"
                               value="{{ request('order_id') }}" min="1">
                        <button class="btn btn-dark px-4" type="submit">Track</button>
                    </div>
                </form>
            </div>
        </div>

        @if($error)
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="alert alert-danger text-center py-4">
                    <i class="fas fa-exclamation-circle fa-2x mb-2 d-block"></i>
                    {{ $error }}
                </div>
            </div>
        </div>
        @endif

        @if($order)
        {{-- Status Timeline --}}
        @php
            $steps = [
                'pending'    => ['label' => 'Order Placed',    'icon' => 'fa-shopping-cart'],
                'processing' => ['label' => 'Processing',      'icon' => 'fa-cog'],
                'shipped'    => ['label' => 'Shipped',         'icon' => 'fa-truck'],
                'delivered'  => ['label' => 'Delivered',       'icon' => 'fa-check-circle'],
            ];
            $statusOrder = array_keys($steps);
            $currentIndex = array_search($order->status, $statusOrder) ?? 0;
        @endphp

        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-3 p-4 p-md-5">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">Order #{{ $order->id }}</h5>
                            <small class="text-muted">
                                Placed on {{ $order->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        <span class="badge bg-dark fs-6 text-capitalize px-3 py-2">
                            {{ $order->status }}
                        </span>
                    </div>

                    {{-- Timeline --}}
                    <div class="d-flex justify-content-between position-relative mb-5">
                        {{-- Progress Line --}}
                        <div class="position-absolute top-50 start-0 w-100"
                             style="height:4px; background:#e9ecef; z-index:0; transform:translateY(-50%)"></div>
                        <div class="position-absolute top-50 start-0"
                             style="height:4px; background:#212529; z-index:1;
                                    width:{{ ($currentIndex / (count($steps)-1)) * 100 }}%;
                                    transform:translateY(-50%); transition:width 0.5s;"></div>

                        @foreach($steps as $key => $step)
                        @php $stepIndex = array_search($key, $statusOrder); @endphp
                        <div class="d-flex flex-column align-items-center position-relative" style="z-index:2; flex:1">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2"
                                 style="width:48px;height:48px;
                                        background:{{ $stepIndex <= $currentIndex ? '#212529' : '#e9ecef' }};
                                        color:{{ $stepIndex <= $currentIndex ? '#fff' : '#adb5bd' }};
                                        border: 3px solid {{ $stepIndex <= $currentIndex ? '#212529' : '#dee2e6' }};">
                                <i class="fas {{ $step['icon'] }}"></i>
                            </div>
                            <small class="fw-semibold text-center {{ $stepIndex <= $currentIndex ? 'text-dark' : 'text-muted' }}">
                                {{ $step['label'] }}
                            </small>
                        </div>
                        @endforeach
                    </div>

                    {{-- Shipment Info --}}
                    @if($order->orderShipments->count() > 0)
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-truck me-2"></i>Shipment Information</h6>
                        @foreach($order->orderShipments as $shipment)
                        <div class="row g-2">
                            <div class="col-md-4">
                                <small class="text-muted">Carrier</small>
                                <p class="fw-semibold mb-0">{{ $shipment->shippingMethod->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Tracking Number</small>
                                <p class="fw-semibold mb-0">{{ $shipment->tracking_number ?? 'Pending' }}</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Estimated Delivery</small>
                                <p class="fw-semibold mb-0">
                                    {{ $shipment->estimated_delivery
                                        ? \Carbon\Carbon::parse($shipment->estimated_delivery)->format('M d, Y')
                                        : 'TBD' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- Order Items --}}
                    <h6 class="fw-bold mb-3">Items in this Order</h6>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end">${{ number_format($item->price ?? 0, 2) }}</td>
                                    <td class="text-end fw-bold">
                                        ${{ number_format(($item->quantity * $item->price) ?? 0, 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total</td>
                                    <td class="text-end fw-bold text-dark">
                                        ${{ number_format($order->total_price ?? 0, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

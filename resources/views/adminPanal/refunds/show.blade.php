@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="extra-header"></div>
    <div class="card-service-section px-0 px-md-0 px-lg-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center bg-teal">
                <div>
                    <a href="{{ route('refunds.index') }}" class="btn btn-light d-flex align-items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Back to Refunds
                    </a>
                </div>
                <span class="text-white fw-semibold">Refund Request #{{ $refund->id }}</span>
                <div></div>
            </div>
        </div>
    </div>

    <div class="product-section px-0 px-md-0 px-lg-3 mt-80">
        <div class="container">
            <div class="row g-4">

                {{-- Refund Details Card --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 border-radius-12">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0">Refund Details</h5>
                                @php
                                    $statusColors = [
                                        'pending'   => 'warning',
                                        'approved'  => 'success',
                                        'rejected'  => 'danger',
                                        'processed' => 'info',
                                    ];
                                    $color = $statusColors[$refund->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }} fs-6 text-capitalize px-3 py-2">
                                    {{ $refund->status ?? 'pending' }}
                                </span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1 small">Refund ID</p>
                                    <p class="fw-semibold">#{{ $refund->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1 small">Request Date</p>
                                    <p class="fw-semibold">{{ $refund->created_at?->format('M d, Y h:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1 small">Order ID</p>
                                    <p class="fw-semibold text-primary">#{{ $refund->order_id ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1 small">Refund Amount</p>
                                    <p class="fw-bold text-danger fs-5">${{ number_format($refund->amount ?? 0, 2) }}</p>
                                </div>
                                <div class="col-12">
                                    <p class="text-muted mb-1 small">Reason</p>
                                    <div class="bg-light rounded p-3">
                                        <p class="mb-0">{{ $refund->reason ?? 'No reason provided.' }}</p>
                                    </div>
                                </div>
                                @if($refund->notes)
                                <div class="col-12">
                                    <p class="text-muted mb-1 small">Admin Notes</p>
                                    <div class="bg-light rounded p-3">
                                        <p class="mb-0">{{ $refund->notes }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Items --}}
                            @if($refund->refundItems && $refund->refundItems->count() > 0)
                            <hr class="my-4">
                            <h6 class="fw-bold mb-3">Refunded Items</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($refund->refundItems as $item)
                                        <tr>
                                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price ?? 0, 2) }}</td>
                                            <td>${{ number_format(($item->quantity * $item->price) ?? 0, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Card --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 border-radius-12">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3">Update Refund Status</h6>

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('refunds.update', $refund->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="pending"   {{ $refund->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                                        <option value="approved"  {{ $refund->status === 'approved'  ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected"  {{ $refund->status === 'rejected'  ? 'selected' : '' }}>Rejected</option>
                                        <option value="processed" {{ $refund->status === 'processed' ? 'selected' : '' }}>Processed</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Admin Notes</label>
                                    <textarea name="notes" rows="3" class="form-control"
                                              placeholder="Add a note to customer...">{{ $refund->notes }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save me-2"></i> Update Status
                                </button>
                            </form>

                            <hr>

                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Customer</span>
                                    <span class="fw-semibold small">{{ $refund->order->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Email</span>
                                    <span class="fw-semibold small">{{ $refund->order->user->email ?? 'N/A' }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Total Amount</span>
                                    <span class="fw-bold text-danger">${{ number_format($refund->amount ?? 0, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

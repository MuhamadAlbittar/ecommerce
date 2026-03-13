@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="extra-header"></div>
    <div class="card-service-section px-0 px-md-0 px-lg-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center bg-teal">
                <div class="d-flex gap-2">
                    <span class="text-white fw-semibold fs-5">Refund Management</span>
                </div>
                <div class="search-box align-items-center d-flex">
                    <i class="fas fa-search text-light"></i>
                    <input type="text" class="form-control border-0 bg-transparent text-light" placeholder="Search refund..." />
                </div>
            </div>
        </div>
    </div>

    <div class="product-section px-0 px-md-0 px-lg-3 mt-80">
        <div class="container">

            {{-- Stats Cards --}}
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm border-radius-12 border-start border-warning border-4">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1 small">Pending Refunds</p>
                                    <h4 class="fw-bold mb-0">{{ $refunds->where('status', 'pending')->count() }}</h4>
                                </div>
                                <i class="fas fa-clock fa-2x text-warning opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm border-radius-12 border-start border-success border-4">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1 small">Approved Refunds</p>
                                    <h4 class="fw-bold mb-0">{{ $refunds->where('status', 'approved')->count() }}</h4>
                                </div>
                                <i class="fas fa-check-circle fa-2x text-success opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm border-radius-12 border-start border-danger border-4">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1 small">Rejected Refunds</p>
                                    <h4 class="fw-bold mb-0">{{ $refunds->where('status', 'rejected')->count() }}</h4>
                                </div>
                                <i class="fas fa-times-circle fa-2x text-danger opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm border-radius-12 border-start border-primary border-4">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1 small">Total Refunds</p>
                                    <h4 class="fw-bold mb-0">{{ $refunds->count() }}</h4>
                                </div>
                                <i class="fas fa-undo fa-2x text-primary opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Refunds Table --}}
            <div class="card shadow-sm border-0 border-radius-12">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">All Refund Requests</h5>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Refund ID</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($refunds as $refund)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge bg-light text-dark">#{{ $refund->id }}</span></td>
                                    <td>
                                        <a href="#" class="text-decoration-none fw-semibold text-primary">
                                            Order #{{ $refund->order_id ?? 'N/A' }}
                                        </a>
                                    </td>
                                    <td>{{ $refund->order->user->name ?? 'N/A' }}</td>
                                    <td class="fw-semibold text-danger">${{ number_format($refund->amount ?? 0, 2) }}</td>
                                    <td>
                                        <span class="d-inline-block text-truncate" style="max-width:150px;"
                                              title="{{ $refund->reason }}">
                                            {{ $refund->reason ?? 'No reason provided' }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending'   => 'warning',
                                                'approved'  => 'success',
                                                'rejected'  => 'danger',
                                                'processed' => 'info',
                                            ];
                                            $color = $statusColors[$refund->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $color }} text-capitalize">
                                            {{ $refund->status ?? 'pending' }}
                                        </span>
                                    </td>
                                    <td>{{ $refund->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('refunds.show', $refund->id) }}"
                                               class="btn btn-sm btn-outline-primary" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($refund->status === 'pending')
                                            <form action="{{ route('refunds.update', $refund->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button class="btn btn-sm btn-outline-success" title="Approve"
                                                        onclick="return confirm('Approve this refund?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('refunds.update', $refund->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button class="btn btn-sm btn-outline-danger" title="Reject"
                                                        onclick="return confirm('Reject this refund?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-5">
                                        <i class="fas fa-undo fa-3x mb-3 d-block opacity-25"></i>
                                        No refund requests found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

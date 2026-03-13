@extends('store.layouts.app')

@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Addresses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<div class="checkout_area bg-white pb-5 pt-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">My Addresses</h3>
            <a href="{{ route('addresses.create') }}" class="btn btn-dark px-4">
                <i class="fas fa-plus me-2"></i> Add New Address
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @forelse($addresses as $address)
        <div class="card mb-3 border {{ $address->is_default ? 'border-dark border-2' : '' }} shadow-sm rounded-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-dark text-uppercase">{{ $address->label }}</span>
                            @if($address->is_default)
                                <span class="badge bg-success">✓ Default</span>
                            @endif
                        </div>
                        <p class="fw-bold mb-1">{{ $address->full_name }}</p>
                        <p class="text-muted mb-1"><i class="fas fa-phone me-1"></i>{{ $address->phone }}</p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ $address->address }}, {{ $address->city }}
                            @if($address->state), {{ $address->state }}@endif
                            @if($address->postal_code) {{ $address->postal_code }}@endif,
                            {{ $address->country }}
                        </p>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        @if(!$address->is_default)
                        <form action="{{ route('addresses.setDefault', $address->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-dark w-100">Set as Default</button>
                        </form>
                        @endif
                        <a href="{{ route('addresses.edit', $address->id) }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST"
                              onsubmit="return confirm('Delete this address?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="fas fa-map-marker-alt fa-4x text-muted mb-3 d-block opacity-25"></i>
            <h5 class="text-muted">No addresses yet</h5>
            <p class="text-muted">Add your first delivery address</p>
            <a href="{{ route('addresses.create') }}" class="btn btn-dark px-4 mt-2">
                Add Address
            </a>
        </div>
        @endforelse

    </div>
</div>
@endsection

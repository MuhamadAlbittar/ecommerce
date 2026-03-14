@extends('store.layouts.app')

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Addresses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="checkout_area bg-white pt-60 pb-60">
    <div class="container">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">My Addresses</h3>
                <p class="text-muted mb-0">Manage your delivery addresses</p>
            </div>
            <a href="{{ route('addresses.create') }}" class="btn btn-dark px-4 py-2">
                <i class="fas fa-plus me-2"></i>Add New Address
            </a>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Addresses List --}}
        @forelse($addresses as $address)
        <div class="card mb-3 rounded-3 border shadow-sm
             {{ $address->is_default ? 'border-dark border-2' : 'border-light' }}">
            <div class="card-body p-4">
                <div class="row align-items-center">

                    {{-- Icon + Info --}}
                    <div class="col-auto d-none d-md-flex align-items-center justify-content-center
                                rounded-circle bg-light me-2"
                         style="width:56px;height:56px;">
                        @if($address->label === 'Home')
                            <i class="fas fa-home fa-lg text-dark"></i>
                        @elseif($address->label === 'Work')
                            <i class="fas fa-briefcase fa-lg text-dark"></i>
                        @else
                            <i class="fas fa-map-marker-alt fa-lg text-dark"></i>
                        @endif
                    </div>

                    <div class="col">
                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                            <span class="badge bg-dark text-uppercase px-3 py-1">
                                {{ $address->label }}
                            </span>
                            @if($address->is_default)
                            <span class="badge bg-success px-3 py-1">
                                <i class="fas fa-check me-1"></i>Default
                            </span>
                            @endif
                        </div>

                        <p class="fw-bold mb-1">{{ $address->full_name }}</p>

                        <p class="text-muted mb-1 small">
                            <i class="fas fa-phone me-1"></i>{{ $address->phone }}
                        </p>

                        <p class="text-muted mb-0 small">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ $address->full_address }}
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="col-12 col-md-auto mt-3 mt-md-0">
                        <div class="d-flex flex-row flex-md-column gap-2">

                            @if(!$address->is_default)
                            <form action="{{ route('addresses.setDefault', $address->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-dark w-100">
                                    <i class="fas fa-star me-1"></i>Set Default
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('addresses.edit', $address->id) }}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>

                            <form action="{{ route('addresses.destroy', $address->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this address? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
        {{-- Empty State --}}
        <div class="text-center py-5 my-5">
            <div class="mb-4">
                <i class="fas fa-map-marked-alt fa-5x text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted fw-bold">No addresses yet</h4>
            <p class="text-muted mb-4">Add your first delivery address to speed up checkout</p>
            <a href="{{ route('addresses.create') }}" class="btn btn-dark px-5 py-2">
                <i class="fas fa-plus me-2"></i>Add My First Address
            </a>
        </div>
        @endforelse

        {{-- Summary --}}
        @if($addresses->count() > 0)
        <p class="text-muted small mt-3 text-center">
            You have {{ $addresses->count() }} {{ Str::plural('address', $addresses->count()) }} saved.
        </p>
        @endif

    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="extra-header"></div>
    <div class="card-service-section px-0 px-md-0 px-lg-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center bg-teal">
                <div class="d-flex d-lg-flex gap-2">
                    <a href="{{ route('vendors.create') }}" class="btn btn-light d-flex align-items-center gap-2">
                        <i class="fas fa-plus"></i> Add Vendor
                    </a>
                </div>
                <div class="search-box align-items-center d-flex">
                    <i class="fas fa-search text-light"></i>
                    <input type="text" class="form-control border-0 bg-transparent text-light" placeholder="Search vendor" />
                </div>
            </div>
        </div>
    </div>

    <div class="product-section px-0 px-md-0 px-lg-3 mt-80">
        <div class="container">
            <div class="card shadow-sm border-0 border-radius-12">
                <div class="card-body p-4">
                    <div class="row align-items-center mb-3">
                        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                            <h5 class="fw-bold">Vendor List</h5>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendors as $vendor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($vendor->hasMedia('vendor-logo'))
                                                    <img src="{{ $vendor->getFirstMediaUrl('vendor-logo') }}"
                                                         width="50" height="50"
                                                         class="rounded-circle object-fit-cover"
                                                         alt="{{ $vendor->name }}">
                                                @else
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width:50px;height:50px;">
                                                        <i class="fas fa-store text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="fw-semibold">{{ $vendor->name }}</td>
                                            <td>{{ $vendor->email ?? 'N/A' }}</td>
                                            <td>{{ $vendor->phone ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $vendor->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $vendor->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('vendors.edit', $vendor->id) }}"
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('vendors.destroy', $vendor->id) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Are you sure you want to delete this vendor?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-store fa-2x mb-2 d-block"></i>
                                                No vendors found.
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
    </div>
</div>
@endsection

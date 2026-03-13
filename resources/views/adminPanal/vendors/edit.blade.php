@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="extra-header"></div>
    <div class="card-service-section px-0 px-md-0 px-lg-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center bg-teal">
                <div class="d-flex gap-2">
                    <a href="{{ route('vendors.index') }}" class="btn btn-light d-flex align-items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Back to Vendors
                    </a>
                </div>
                <span class="text-white fw-semibold">Edit Vendor: {{ $vendor->name }}</span>
                <div></div>
            </div>
        </div>
    </div>

    <div class="product-section px-0 px-md-0 px-lg-3 mt-80">
        <div class="container">
            <div class="card shadow-sm border-0 border-radius-12">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Edit Vendor Information</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Vendor Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $vendor->name) }}">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $vendor->email) }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $vendor->phone) }}">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', $vendor->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $vendor->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" rows="3"
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $vendor->description) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Current Logo</label>
                                <div class="mb-2">
                                    @if($vendor->hasMedia('vendor-logo'))
                                        <img src="{{ $vendor->getFirstMediaUrl('vendor-logo') }}"
                                             width="80" height="80" class="rounded object-fit-cover border"
                                             alt="Current logo">
                                    @else
                                        <span class="text-muted">No logo uploaded</span>
                                    @endif
                                </div>
                                <label class="form-label fw-semibold">Change Logo</label>
                                <input type="file" name="image" accept="image/*"
                                       class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                <a href="{{ route('vendors.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i> Update Vendor
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

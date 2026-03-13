@extends('store.layouts.app')

@section('content')
<div class="breadcrumb_area">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('addresses.index') }}">Addresses</a></li>
            <li class="breadcrumb-item active">Add New Address</li>
        </ol>
    </div>
</div>

<div class="checkout_area bg-white pb-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="fw-bold mb-4">Add New Address</h4>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                                    <select name="label" class="form-select @error('label') is-invalid @enderror">
                                        <option value="">-- Choose --</option>
                                        <option value="Home"   {{ old('label') === 'Home'   ? 'selected' : '' }}>🏠 Home</option>
                                        <option value="Work"   {{ old('label') === 'Work'   ? 'selected' : '' }}>💼 Work</option>
                                        <option value="Other"  {{ old('label') === 'Other'  ? 'selected' : '' }}>📍 Other</option>
                                    </select>
                                    @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name"
                                           class="form-control @error('full_name') is-invalid @enderror"
                                           value="{{ old('full_name', Auth::user()->name) }}">
                                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" placeholder="+962...">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                                    <input type="text" name="country"
                                           class="form-control @error('country') is-invalid @enderror"
                                           value="{{ old('country', 'Jordan') }}">
                                    @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Street Address <span class="text-danger">*</span></label>
                                    <textarea name="address" rows="2"
                                              class="form-control @error('address') is-invalid @enderror"
                                              placeholder="Building, street, area...">{{ old('address') }}</textarea>
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city"
                                           class="form-control @error('city') is-invalid @enderror"
                                           value="{{ old('city') }}">
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">State / Province</label>
                                    <input type="text" name="state"
                                           class="form-control @error('state') is-invalid @enderror"
                                           value="{{ old('state') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Postal Code</label>
                                    <input type="text" name="postal_code"
                                           class="form-control @error('postal_code') is-invalid @enderror"
                                           value="{{ old('postal_code') }}">
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               name="is_default" value="1" id="isDefault"
                                               {{ old('is_default') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="isDefault">
                                            Set as my default address
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 d-flex gap-2 justify-content-end mt-2">
                                    <a href="{{ route('addresses.index') }}"
                                       class="btn btn-outline-secondary px-4">Cancel</a>
                                    <button type="submit" class="btn btn-dark px-4">
                                        <i class="fas fa-save me-2"></i> Save Address
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

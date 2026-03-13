@extends('store.layouts.app')

@section('content')
<div class="breadcrumb_area">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('addresses.index') }}">My Addresses</a></li>
            <li class="breadcrumb-item active">Add New Address</li>
        </ol>
    </div>
</div>

<div class="checkout_area bg-white pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">

                <div class="card border-0 shadow rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <div class="mb-4">
                            <h4 class="fw-bold mb-1">Add New Address</h4>
                            <p class="text-muted small mb-0">Fill in your delivery information</p>
                        </div>

                        {{-- Errors --}}
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">

                                {{-- Label --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        Address Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @foreach(['Home' => 'fa-home', 'Work' => 'fa-briefcase', 'Other' => 'fa-map-marker-alt'] as $opt => $icon)
                                        <div>
                                            <input type="radio" class="btn-check" name="label"
                                                   id="label_{{ $opt }}" value="{{ $opt }}"
                                                   {{ old('label', 'Home') === $opt ? 'checked' : '' }}>
                                            <label class="btn btn-outline-dark" for="label_{{ $opt }}">
                                                <i class="fas {{ $icon }} me-1"></i>{{ $opt }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('label')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Name --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="full_name"
                                           class="form-control @error('full_name') is-invalid @enderror"
                                           value="{{ old('full_name', Auth::user()->name) }}"
                                           placeholder="John Doe">
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Phone <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}"
                                           placeholder="+962 7x xxx xxxx">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Street Address --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        Street Address <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="address" rows="2"
                                              class="form-control @error('address') is-invalid @enderror"
                                              placeholder="Building number, street name, neighborhood...">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- City --}}
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">
                                        City <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="city"
                                           class="form-control @error('city') is-invalid @enderror"
                                           value="{{ old('city') }}"
                                           placeholder="Amman">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- State --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">State / Province</label>
                                    <input type="text" name="state"
                                           class="form-control"
                                           value="{{ old('state') }}"
                                           placeholder="Optional">
                                </div>

                                {{-- Postal Code --}}
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Postal Code</label>
                                    <input type="text" name="postal_code"
                                           class="form-control"
                                           value="{{ old('postal_code') }}"
                                           placeholder="11110">
                                </div>

                                {{-- Country --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        Country <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="country"
                                           class="form-control @error('country') is-invalid @enderror"
                                           value="{{ old('country', 'Jordan') }}">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Default --}}
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               role="switch" name="is_default"
                                               id="isDefault" value="1"
                                               {{ old('is_default') ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="isDefault">
                                            Set as my default delivery address
                                        </label>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="col-12 d-flex gap-2 justify-content-between mt-2">
                                    <a href="{{ route('addresses.index') }}"
                                       class="btn btn-outline-secondary px-4">
                                        <i class="fas fa-arrow-left me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-dark px-5">
                                        <i class="fas fa-save me-2"></i>Save Address
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

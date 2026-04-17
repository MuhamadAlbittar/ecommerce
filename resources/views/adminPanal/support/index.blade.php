@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container mt-150">

        <div class="card shadow-sm border-0 border-radius-12 p-4">
            <h3 class="mb-4">Help & Support Settings</h3>

            <form action="{{ route('support.create') }}" method="POST">
                @csrf

                <h5 class="mb-3">Store Support</h5>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="store_email" class="form-control"
                           value="{{ $settings->store_email ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="store_phone" class="form-control"
                           value="{{ $settings->store_phone ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="store_address" class="form-control">{{ $settings->store_address ?? '' }}</textarea>
                </div>

                <hr>

                <h5 class="mb-3">Vendor Contact</h5>
                <div class="mb-3">
                    <label>Vendor Phone</label>
                    <input type="text" name="vendor_phone" class="form-control"
                           value="{{ $settings->vendor_phone ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Vendor Email</label>
                    <input type="text" name="vendor_email" class="form-control"
                           value="{{ $settings->vendor_email ?? '' }}">
                </div>

                <hr>

                <h5 class="mb-3">Seller Contact</h5>
                <div class="mb-3">
                    <label>Seller Phone</label>
                    <input type="text" name="seller_phone" class="form-control"
                           value="{{ $settings->seller_phone ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Seller Email</label>
                    <input type="text" name="seller_email" class="form-control"
                           value="{{ $settings->seller_email ?? '' }}">
                </div>

                <button class="btn custom-bg-primary text-white mt-3">Save Changes</button>

            </form>

        </div>

    </div>
</div>
@endsection

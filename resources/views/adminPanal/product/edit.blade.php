@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
        <div class="container">

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- PRODUCT INFO -->
                    <div class="col-12">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-header bg-white pt-3">
                                <h5 class="fw-normal text-start">Product information</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Product ID</label>
                                        <input type="text" class="form-control" name="product_id" value="{{ $product->product_id }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Vendor</label>
                                        <input type="text" class="form-control" name="vendor" value="{{ $product->vendor }}">
                                    </div>

                                    {{-- 🔥 حالة المنتج --}}
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select 
                                            name="status" 
                                            id="status" 
                                            class="form-select @error('status') is-invalid @enderror"
                                        >
                                            <option value="In Stock" {{ old('status') == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                                            <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MEDIA -->
                    <div class="col-12">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-header bg-white pt-3">
                                <h5 class="fw-normal text-start">Media</h5>

                                <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">

                                @if($product->image)
                                    <img src="{{ asset('uploads/products/' . $product->image) }}" 
                                         style="max-width: 200px; margin-top: 10px;">
                                @endif

                                <img id="previewImage" style="max-width: 200px; margin-top: 10px; display:none;">
                            </div>

                            <div class="card-body p-4">
                                <div class="file-upload-container">
                                    <div id="dropzone" class="dropzone">
                                        <p>Drag and drop your file here</p>
                                        <p>or</p>
                                        <a href="javascript:void(0)" id="browseButton">Browse files</a>
                                        <input id="fileInput" type="file" multiple hidden>
                                    </div>

                                    <div id="preview" class="preview-grid"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PRICING -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-header bg-white pt-3">
                                <h5 class="fw-normal text-start">Pricing</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">

                                    <div class="col-md-12">
                                        <label class="form-label">Actual Price</label>
                                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Sale Price</label>
                                        <input type="text" class="form-control" name="sale_price" value="{{ $product->sale_price }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ORGANIZATION -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-header bg-white pt-3">
                                <h5 class="fw-normal text-start">Organization</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">

                                    <div class="col-md-12">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" name="category_id">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" 
                                                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Tags</label>
                                        <input type="text" class="form-control" name="tags" value="{{ $product->tags }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-body p-4 d-flex">
                                <a href="{{ route('products.index') }}" class="btn text-primary border-color hover-bg-primary w-50 me-2">Cancel</a>
                                <button type="submit" class="btn custom-bg-primary w-50 text-white btn-hover">Update</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
document.getElementById('fileInput').addEventListener('change', function(e) {
    let preview = document.getElementById('preview');
    preview.innerHTML = "";

    Array.from(e.target.files).forEach(file => {
        let reader = new FileReader();
        reader.onload = function(event) {
            let img = document.createElement('img');
            img.src = event.target.result;
            img.style.width = "150px";
            img.style.margin = "10px";
            img.style.borderRadius = "8px";
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
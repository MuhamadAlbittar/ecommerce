@extends('layouts.app')
@section('content')
<div class="main-content">
                <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
                    <div class="container">
                         <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                        <div class="card-header bg-white pt-3">
                            <h5 class="fw-normal text-start">Product information</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Product ID</label>
                                    <input type="text" class="form-control" name="product_id">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Vendor</label>
                                    <input type="text" class="form-control" name="vendor">
                                </div>
                                
                                {{-- 🔥 حالة المنتج --}}
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select 
                                        name="status" 
                                        id="status" 
                                        class="form-select @error('status') is-invalid @enderror"
                                    >
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
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
                                    <input type="text" class="form-control" name="price">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Sale Price</label>
                                    <input type="text" class="form-control" name="sale_price">
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
                                        <option selected disabled>Choose...</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Tags</label>
                                    <input type="text" class="form-control" name="tags">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12">
            <div class="card shadow-sm border-0 border-radius-12 mb-4">
                <div class="card-header bg-white pt-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-normal text-start">Variants</h5>
                    <a href="javascript:void(0)" class="btn text-primary border-color hover-bg-primary" id="add-variant"><i class="fas fa-plus"></i> Add Variant</a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody id="variants-table">
                            <!-- Rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

                <!-- BUTTONS -->
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                        <div class="card-body p-4 d-flex">
                            <a href="{{ route('products.index') }}" class="btn text-primary border-color hover-bg-primary w-50 me-2">Discard</a>
                            <button type="submit" class="btn custom-bg-primary w-50 text-white btn-hover">Save</button>
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
                preview.innerHTML = ""; // مسح الصور القديمة

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

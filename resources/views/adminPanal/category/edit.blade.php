@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
        <div class="container">

            <form action="{{ route('categories.update', $category->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Category Information --}}
                    <div class="col-12">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-header bg-white pt-3">
                                <h5 class="fw-normal text-start">Edit Category</h5>
                            </div>

                            <div class="card-body p-4">
                                <div class="row g-3">

                                    {{-- Name --}}
                                    <div class="col-md-6">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input 
                                            name="name" 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="inputName"
                                            value="{{ old('name', $category->name) }}"
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Status</label>
                                        <select 
                                            name="status" 
                                            id="inputState" 
                                            class="form-select @error('status') is-invalid @enderror"
                                        >
                                            <option value="">Choose...</option>
                                            <option value="Active" {{ old('status', $category->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $category->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Upload Image --}}
                    <div class="col-12">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-header bg-white pt-3">
                                <h5 class="fw-normal text-start">Category Image</h5>
                            </div>

                            <div class="card-body p-4">

                                {{-- Current Image Preview --}}
                                @if($category->image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div>
                                            <img 
                                                src="{{ asset('storage/' . $category->image) }}" 
                                                alt="Category Image" 
                                                class="p-img-thumbnail"
                                                style="width: 120px; border-radius: 8px;"
                                            >
                                        </div>
                                    </div>
                                @endif

                                <div class="file-upload-container">

                                    <div id="dropzone" class="dropzone">
                                        <div class="icon">
                                            <svg width="90" height="90" viewBox="0 0 105 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <!-- SVG تبعك -->
                                            </svg>
                                        </div>

                                        <p>Drag and drop your file here</p>
                                        <p>or</p>
                                        <a href="javascript:void(0)" id="browseButton">Browse files</a>

                                        <input 
                                            name="image" 
                                            id="fileInput" 
                                            type="file" 
                                            hidden
                                        />
                                    </div>

                                    <div id="preview" class="preview-grid"></div>

                                    @error('image')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="card shadow-sm border-0 border-radius-12 mb-4">
                            <div class="card-body p-4 d-flex">
                                <a href="{{ route('categories.index') }}" class="btn text-primary border-color hover-bg-primary w-50 me-2">
                                    Cancel
                                </a>

                                <button type="submit" class="btn custom-bg-primary w-50 text-white btn-hover">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>

                </div> {{-- row --}}
            </form>

        </div>
    </div>
</div>
@endsection
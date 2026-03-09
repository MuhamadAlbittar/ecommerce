@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
      <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                        <div class="card-header bg-white pt-3">
                            <h5 class="fw-normal text-start">edit vendor</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$vendor->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">email</label>
                                    <input type="text" class="form-control" name="email" value="{{$vendor->email}}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$vendor->phone}}">
                                </div>
                              {{-- حالة المتجر --}}
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" value='{{$vendor->status}}' >
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" value='{{$vendor->description}}'></textarea>
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
                            <img id="previewImage" style="max-width: 200px; margin-top: 10px"; src="{{$vendor->getFirstMediaUrl('vendor-logo')}}">

                            <img id="previewImage" style="max-width: 200px; margin-top: 10px; display:none;" >
                           <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" >
                        </div>
                     <div class="col-12 col-lg-6 offset-lg-3">
                       <div class="card shadow-sm border-0 border-radius-12 mb-4">
                           <div class="card-body p-4 d-flex">
                              <button type="submit" class="btn custom-bg-primary w-50 text-white btn-hover">update</button>
                           </div>
                       </div>
                     </div>
                 </div>
                </div>
            </div>
        </form>

                    </div>
                </div>
            </div>

         {{-- <script>
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
            </script> --}}
@endsection

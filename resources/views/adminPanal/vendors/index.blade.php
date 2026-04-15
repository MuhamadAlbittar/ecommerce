@extends('layouts.app')
    @section('content')
{{-- {{ dd($vendor->users) }} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <button type="button" class="btn m-3" 
                        style="background-color: #266663; border-color: #266663; color: #FFFFFF;" 
                        data-bs-toggle="modal" data-bs-target="#addVendorModal">
                    Add Vendor
                </button>


                 @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                <div class="card shadow-sm border-0 border-radius-12">
                    <div class="card-body p-4">

                        <div class="row align-items-center mb-3">
                            <!-- Title -->
                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                <h5 class="fw-bold text-start text-md-start">Vendors List</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3">ID</th>
                                        <th scope="col" class="py-3">Image</th>
                                        <th scope="col" class="py-3">Name</th>
                                        <th scope="col" class="py-3">Email</th>
                                        <th scope="col" class="py-3">Phone</th>
                                        <th scope="col" class="py-3">Join Date</th>
                                        <th scope="col" class="py-3">Status</th>
                                        <th scope="col" class="py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->id }}</td>
                                        <td><img src="{{ $vendor->getFirstMediaUrl('vendor-logo') }}" alt="Vendor Image" class="img-fluid" width="100"></td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->phone }}</td>
                                        <td>{{ $vendor->created_at->format('d M, Y g:i A') }}</td>
                                        <td>{{ $vendor->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{route('vendors.show', $vendor->id)}}" class="btn btn-sm"><i class="fa-solid fa-store" style="color:blue"></i></a>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editVendorModal{{ $vendor->id }}">
                                            <i class="fa-solid fa-edit" style="color:green"></i>
                                            </button>

                                            <!-- Modal Edit Vendor -->

                                            <div class="modal fade" id="editVendorModal{{ $vendor->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">

                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Vendor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Form -->
                                                <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">
                                                    <div class="row g-3">

                                                        <div class="col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ $vendor->name }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" name="email" value="{{ $vendor->email }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                        <label class="form-label">Phone</label>
                                                        <input type="text" class="form-control" name="phone" value="{{ $vendor->phone }}">
                                                        </div>

                                                        <!-- Status -->
                                                        <div class="col-md-6">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="1" {{ $vendor->status == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $vendor->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                        </div>

                                                        <!-- Description -->
                                                        <div class="col-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description">{{ $vendor->description }}</textarea>
                                                        </div>

                                                        <!-- Image -->
                                                        <div class="col-12">
                                                        <label class="form-label">Image</label>

                                                        <!-- الصورة الحالية -->
                                                        <img src="{{ $vendor->getFirstMediaUrl('vendor-logo') }}"
                                                            style="max-width: 200px; margin-bottom:10px; display:block;">

                                                        <!-- معاينة الجديدة -->
                                                        <img id="previewImage{{ $vendor->id }}"
                                                            style="max-width: 200px; display:none; margin-bottom:10px;">

                                                        <input type="file"
                                                                name="image"
                                                                id="imageInput{{ $vendor->id }}"
                                                                class="form-control"
                                                                accept="image/*">
                                                        </div>

                                                    </div>
                                                    </div>

                                                    <!-- Footer -->
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>

                                                </form>

                                                </div>
                                            </div>
                                            </div>
                                            <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this vendor?')"><i class="fa-solid fa-trash" style="color:red"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- pagination -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div>
                    <p class="mt-4 mt-sm-4 mt-md-4 mt-lg-1 text-center text-md-start">Showing 1 - 20 of 121</p>
                    </div>
                    <ul class="pagination">
                    <li><a href="#" class="pagination-link disabled" tabindex="-1">&lt;</a></li>
                    <li><a href="#" class="pagination-link active">1</a></li>
                    <li><a href="#" class="pagination-link">2</a></li>
                    <li><a href="#" class="pagination-link">3</a></li>
                    <li><a href="#" class="pagination-link">4</a></li>
                    <li><a href="#" class="pagination-link">&gt;</a></li>
                    </ul>
                </div>
            <!-- end pagination -->
            </div>
        </div>
    </div>

            <!-- Modal Add Vendor -->
        <div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- حجم كبير -->
            <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addVendorModalLabel">Add Vendor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('vendors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Body -->
                <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                    </div>

                    <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                    </div>

                    <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone">
                    </div>

                    <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    </div>

                    <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                    </div>

                    <!-- Image -->
                    <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" id="vendorImageInput" class="form-control" accept="image/*">
                    <img id="vendorPreviewImage" style="max-width: 200px; margin-top: 10px; display:none;">
                    </div>

                </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Vendor</button>
                </div>

            </form>

            </div>
        </div>
        </div>
    @endsection

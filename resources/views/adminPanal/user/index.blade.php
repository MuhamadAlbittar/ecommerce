@extends('layouts.app')
@section('content')
<button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#addSellerModal">
  Add Seller
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
        <div class="container">
                        <div class="card shadow-sm border-0 border-radius-12">
                            <div class="card-body p-4">
                                <div class="row align-items-center mb-3">
                                    <!-- Title -->
                                    <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                        <h5 class="fw-bold text-start text-md-start">User List</h5>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="py-3">ID</th>
                                                <th scope="col" class="py-3">image</th>
                                                <th scope="col" class="py-3">Name</th>
                                                <th scope="col" class="py-3">Email</th>
                                                <th scope="col" class="py-3">Phone</th>
                                                <th scope="col" class="py-3">Join Date</th>
                                                <th scope="col" class="py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sellers as $seller)
                                                <tr>
                                                    <td>{{ $seller->id }}</td>
                                                    <td>
                                                        @if ($seller->getFirstMediaUrl('user-image'))
                                                            <img src="{{ $seller->getFirstMediaUrl('user-image') }}" alt="User Image" class="rounded-circle" width="50" height="50">
                                                        @else
                                                            <img src="{{ asset('default-user.png') }}" alt="Default User Image" class="rounded-circle" width="50" height="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $seller->name }}</td>
                                                <td>{{ $seller->email }}</td>
                                                <td>{{ $seller->phone }}</td>
                                                <td>{{ $seller->created_at->format('d M, Y g:i A') }}</td>
                                                <td >
                                                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editSellerModal{{ $seller->id }}"><i class="fa-solid fa-edit" style="color:green"></i></button>

                                                    <!-- Modal Edit Seller -->
                                                    <div class="modal fade" id="editSellerModal{{ $seller->id }}" tabindex="-1" aria-labelledby="editSellerModalLabel{{ $seller->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editSellerModalLabel{{ $seller->id }}">Edit Seller</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form action="{{ route('sellers.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $seller->name }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Email</label>
                                                                <input type="text" class="form-control" name="email" value="{{ $seller->email }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Password (leave blank to keep current)</label>
                                                                <input type="password" class="form-control" name="password">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Confirm Password</label>
                                                                <input type="password" class="form-control" name="password_confirmation">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Phone</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ $seller->phone }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Country</label>
                                                                <input type="text" class="form-control" name="country" value="{{ $seller->country }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">City</label>
                                                                <input type="text" class="form-control" name="city" value="{{ $seller->city }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Street</label>
                                                                <input type="text" class="form-control" name="street" value="{{ $seller->street }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label class="form-label">Building</label>
                                                                <input type="text" class="form-control" name="building" value="{{ $seller->building }}">
                                                                </div>

                                                                <!-- Media -->
                                                                <div class="col-md-12 mt-2">
                                                                <label class="form-label">Image</label>
                                                                <input type="file" name="image" id="imageInput{{ $seller->id }}" class="form-control" accept="image/*">
                                                                @if($seller->image)
                                                                    <img id="previewImage{{ $seller->id }}" src="{{ asset('uploads/'.$seller->image) }}" style="max-width: 200px; margin-top: 10px;">
                                                                @else
                                                                    <img id="previewImage{{ $seller->id }}" style="max-width: 200px; margin-top: 10px; display:none;">
                                                                @endif
                                                                </div>
                                                            </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update Seller</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>

                                                <form action="{{ route('sellers.destroy', $seller->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this seller?')"><i class="fa-solid fa-trash" style="color:red"></i></button>
                                            </form>
                                                    <div class="dropdown">
                                                        <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item py-2" href="#">Block</a></li>
                                                        </ul>
                                                    </div>
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

         <!-- Modal to add seller -->
<div class="modal fade" id="addSellerModal" tabindex="-1" aria-labelledby="addSellerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSellerModalLabel">Add Seller</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('sellers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" name="phone">
            </div>
            <div class="col-md-6">
              <label class="form-label">Country</label>
              <input type="text" class="form-control" name="country">
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" class="form-control" name="city">
            </div>
            <div class="col-md-6">
              <label class="form-label">Street</label>
              <input type="text" class="form-control" name="street">
            </div>
            <div class="col-md-6">
              <label class="form-label">Building</label>
              <input type="text" class="form-control" name="building">
            </div>

            <!-- Media -->
            <div class="col-md-12 mt-2">
              <label class="form-label">Image</label>
              <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
              <img id="previewImage" style="max-width: 200px; margin-top: 10px; display:none;">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Seller</button>
        </div>
      </form>

    </div>
  </div>
</div>


@endsection

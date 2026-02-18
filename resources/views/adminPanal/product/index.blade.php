@extends('layouts.app')
@section('content')
<div class="main-content">
                <div class="extra-header"></div>
                <div class="card-service-section px-0 px-md-0 px-lg-3">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center bg-teal">
                            <!-- Import and Export Buttons -->
                            <div class="d-flex d-lg-flex gap-2">
                              <button class="btn btn-light d-none d-sm-none d-md-none d-lg-flex align-items-center gap-2">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Import
                              </button>
                              <button class="btn btn-light d-none d-sm-none d-md-none d-lg-flex align-items-center gap-2">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Export
                              </button>
                              <!-- Add Product Button -->
                               <a href="{{ route('products.create') }}" class="btn btn-light d-flex align-items-center gap-2"><i class="fas fa-plus"></i> Add Product</a>
                            </div>
                            <!-- Search Input -->
                            <div class="search-box align-items-center  d-flex">
                              <i class="fas fa-search text-light"></i>
                              <input
                                type="text"
                                class="form-control border-0 bg-transparent text-light"
                                placeholder="Search product"
                              />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-section px-0 px-md-0 px-lg-3 mt-80">
                    <div class="container">
                        <div class="card shadow-sm border-0 border-radius-12">
                            <div class="card-body p-4">
                                <div class="row align-items-center mb-3">
                                    <!-- Title -->
                                    <div class="col-12  col-sm-12 col-md-12 col-lg-8 mb-4 mb-sm-4 mb-md-4 mb-lg-0 d-flex justify-content-between justify-content-lg-start ">
                                        <h5 class="fw-bold text-start text-md-start">Product List</h5>
                                        <button class="btn bg-disabled d-flex  align-items-center ms-4">
                                            <i class="fas fa-trash"></i> <span class="ms-2">Delete</span>
                                        </button>
                                    </div>
                                    <!-- Filters and Sort -->
                                    <div class="col-12  col-sm-12 col-md-12 col-lg-4 d-flex justify-content-end justify-content-md-end flex-wrap gap-2">
                                        <!-- Filter Dropdown -->
                                        <div class="dropdown">
                                            <a class="nav-link custom-bg-primary text-white rounded px-3 py-2" href="#" id="FilterMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Filter By <i class="fas fa-filter"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="FilterMenuLink">
                                                <li><a class="dropdown-item py-2" href="#">In Stock</a></li>
                                                <li><a class="dropdown-item py-2" href="#">Out of Stock</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                              <thead>
                                                <tr>
                                                  <th scope="col" class="py-3">
                                                    <input type="checkbox" id="select-all" class="custom-checkbox">
                                                  </th>
                                                  <th scope="col" class="py-3">Product ID</th>
                                                  <th scope="col" class="py-3">Image</th>
                                                  <th scope="col" class="py-3">Product Name</th>
                                                  <th scope="col" class="py-3">Category</th>
                                                  <th scope="col" class="py-3">Price</th>
                                                  <th scope="col" class="py-3">Stock</th>
                                                  <th scope="col" class="py-3">SKU</th>
                                                  <th scope="col" class="py-3">Status</th>
                                                  <th scope="col" class="py-3">Actions</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach ($products as $product)
                                                      <tr>
                                                          <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>

                                                          <td>#{{ $product->id }}</td>

                                                          <td>
                                                              @if($product->image)
                                                                  <img src="{{ asset('uploads/products/' . $product->image) }}" 
                                                                      alt="Product Image" class="p-img-thumbnail">
                                                              @else
                                                                  <span>No Image</span>
                                                              @endif
                                                          </td>

                                                          <td>{{ $product->name }}</td>

                                                          <td>{{ $product->category->name ?? 'No Category' }}</td>

                                                          <td>{{ $product->price }}</td>

                                                          <td>{{ $product->stock ?? 0 }}</td>

                                                          <td>{{ $product->sku ?? '-' }}</td>

                                                          <td>
                                                              <span class="status-badge status-success">
                                                                  {{ $product->status ?? 'Active' }}
                                                              </span>
                                                          </td>

                                                          <td>
                                                              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm">
                                                                  <i class="fa-solid fa-edit"></i>
                                                              </a>

                                                            <button type="button" class="btn btn-sm text-danger" onclick="openDeleteModal({{ $product->id }})">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                          </td>
                                                      </tr>
                                                  @endforeach

                                              </tbody>
                                            </table>
                                        </div>
                                      </div>
                                    </div>
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
                        <div id="deleteModal" class="modal-overlay" style="display:none;">
                            <div class="modal-box">
                                <h4>Are you sure?</h4>
                                <p>This action will permanently delete the product.</p>

                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger w-100 mt-3">Yes, Delete</button>
                                </form>

                                <button class="btn btn-secondary w-100 mt-2" onclick="closeDeleteModal()">Cancel</button>
                            </div>
                        </div>
                        <style>
                            .modal-overlay {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background: rgba(0,0,0,0.55);
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                z-index: 99999;
                            }

                            .modal-box {
                                background: #fff;
                                padding: 25px;
                                border-radius: 12px;
                                width: 350px;
                                text-align: center;
                                box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                            }
                        </style>
                        <script>
                            function openDeleteModal(id) {
                                let form = document.getElementById('deleteForm');
                                form.action = "/products/" + id;
                                document.getElementById('deleteModal').style.display = 'flex';
                            }

                            function closeDeleteModal() {
                                document.getElementById('deleteModal').style.display = 'none';
                            }
                        </script>
                    </div>
                </div>
           </div>
@endsection

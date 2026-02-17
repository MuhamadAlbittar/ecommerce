@extends('layouts.app')
@section('content')
<div class="main-content">
                <div class="extra-header"></div>
                <div class="card-service-section px-0 px-md-0 px-lg-3">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center bg-teal">
                              <a href="category-add.html" class="btn btn-light d-flex align-items-center gap-2"><i class="fas fa-plus"></i> Add category</a>
                              <div class="search-box align-items-center d-flex">
                                <i class="fas fa-search text-light"></i>
                                <input
                                  type="text"
                                  class="form-control border-0 bg-transparent text-light"
                                  placeholder="Search category"
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
                                        <h5 class="fw-bold text-start text-md-start">Category List</h5>
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
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                      <thead>
                                        <tr>
                                          <th scope="col" class="py-3">
                                            <input type="checkbox" id="select-all" class="custom-checkbox">
                                          </th>
                                          <th scope="col" class="py-3">Name</th>
                                          <th scope="col" class="py-3">Image</th>
                                          <th scope="col" class="py-3">Quantity</th>
                                          <th scope="col" class="py-3">Status</th>
                                          <th scope="col" class="py-3">Actions</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                          <td>Fashion</td>
                                          <td><img src="./assets/images/p1.jfif" alt="Product Image" class="p-img-thumbnail"></td>
                                          <td>25</td>
                                          <td><span class="status-badge status-success">Active</span></td>
                                          <td>
                                            <a href="#" class="btn btn-sm"><i class="fa-solid fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            <div class="dropdown">
                                                <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item py-2" href="#">Active</a></li>
                                                    <li><a class="dropdown-item py-2" href="#">Inactive</a></li>
                                                </ul>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                            <td>Sport</td>
                                            <td><img src="./assets/images/p1.jfif" alt="Product Image" class="p-img-thumbnail"></td>
                                            <td>25</td>
                                            <td><span class="status-badge status-danger">Inactive</span></td>
                                            <td>
                                              <a href="#" class="btn btn-sm"><i class="fa-solid fa-edit"></i></a>
                                              <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
                                              <div class="dropdown">
                                                <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item py-2" href="#">Active</a></li>
                                                    <li><a class="dropdown-item py-2" href="#">Inactive</a></li>
                                                </ul>
                                            </div>
                                            </td>
                                          </tr>
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
@endsection

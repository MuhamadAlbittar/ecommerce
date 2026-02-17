@extends('layouts.app')
@section('content')
<div class="main-content">
                <div class="extra-header"></div>
                <div class="card-service-section px-0 px-md-0 px-lg-3">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center bg-teal">
                            <!-- Import Buttons -->
                            <div class="d-flex gap-2">
                                <button class="btn btn-light d-flex align-items-center gap-2">
                                  <i class="fa-solid fa-cloud-arrow-up"></i> Import
                                </button>
                              </div>
                            <!-- Search Input -->
                            <div class="search-box align-items-center  d-flex">
                              <i class="fas fa-search text-light"></i>
                              <input
                                type="text"
                                class="form-control border-0 bg-transparent text-light"
                                placeholder="Search order"
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
                                    <div class="col-6 col-md-auto mb-0 mb-md-0 d-flex">
                                        <h5 class="fw-bold text-start text-md-start">Order List</h5>
                                    </div>
                                    <!-- Filters and Sort -->
                                    <div class="col-6 col-md d-flex justify-content-end flex-wrap gap-2">
                                        <!-- Filter Dropdown -->
                                        <div class="dropdown">
                                            <a class="nav-link custom-bg-primary text-white rounded px-3 py-2" href="#" id="FilterMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Filter By <i class="fas fa-filter"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="FilterMenuLink">
                                                <li><a class="dropdown-item py-2" href="#">Pending</a></li>
                                                <li><a class="dropdown-item py-2" href="#">Delivered</a></li>
                                                <li><a class="dropdown-item py-2" href="#">Processing</a></li>
                                                <li><a class="dropdown-item py-2" href="#">Cancel</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="py-3">Invoice no</th>
                                                <th scope="col" class="py-3">Customer Name</th>
                                                <th scope="col" class="py-3">Method</th>
                                                <th scope="col" class="py-3">Amount</th>
                                                <th scope="col" class="py-3">Order time</th>
                                                <th scope="col" class="py-3">Status</th>
                                                <th scope="col" class="py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12598</td>
                                                <td>John Doe</td>
                                                <td>Cash</td>
                                                <td>$4,099</td>
                                                <td>24 Nov, 2024 3:59 PM</td>
                                                <td><span class="status-badge status-success">Delivered</span></td>
                                                <td class="d-flex justify-content-between">
                                                    <div class="mb-2 w-75">
                                                        <select class="form-select form-select-sm border bg-light text-secondary rounded" aria-label="Order Status">
                                                            <option value="status">Pending</option>
                                                            <option value="Delivered" selected>Delivered</option>
                                                            <option value="Processing">Processing</option>
                                                            <option value="Cancel">Cancel</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown w-25">
                                                        <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item py-2" href="#">View</a></li>
                                                            <li><a class="dropdown-item py-2" href="invoice.html">Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12598</td>
                                                <td>John Doe</td>
                                                <td>Cash</td>
                                                <td>$4,099</td>
                                                <td>24 Nov, 2024 3:59 PM</td>
                                                <td><span class="status-badge status-danger">Cancel</span></td>
                                                <td class="d-flex justify-content-between">
                                                    <div class="mb-2 w-75">
                                                        <select class="form-select form-select-sm border bg-light text-secondary rounded" aria-label="Order Status">
                                                            <option value="status">Pending</option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Processing">Processing</option>
                                                            <option value="Cancel" selected>Cancel</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown w-25">
                                                        <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item py-2" href="#">View</a></li>
                                                            <li><a class="dropdown-item py-2" href="invoice.html">Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12598</td>
                                                <td>John Doe</td>
                                                <td>Cash</td>
                                                <td>$4,099</td>
                                                <td>24 Nov, 2024 3:59 PM</td>
                                                <td><span class="status-badge status-info">Processing</span></td>
                                                <td class="d-flex justify-content-between">
                                                    <div class="mb-2 w-75">
                                                        <select class="form-select form-select-sm border bg-light text-secondary rounded" aria-label="Order Status">
                                                            <option value="status">Pending</option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Processing" selected>Processing</option>
                                                            <option value="Cancel">Cancel</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown w-25">
                                                        <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item py-2" href="#">View</a></li>
                                                            <li><a class="dropdown-item py-2" href="invoice.html">Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12598</td>
                                                <td>John Doe</td>
                                                <td>Cash</td>
                                                <td>$4,099</td>
                                                <td>24 Nov, 2024 3:59 PM</td>
                                                <td><span class="status-badge status-info">Processing</span></td>
                                                <td class="d-flex justify-content-between">
                                                    <div class="mb-2 w-75">
                                                        <select class="form-select form-select-sm border bg-light text-secondary rounded" aria-label="Order Status">
                                                            <option value="status">Pending</option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Processing" selected>Processing</option>
                                                            <option value="Cancel">Cancel</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown w-25">
                                                        <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item py-2" href="#">View</a></li>
                                                            <li><a class="dropdown-item py-2" href="invoice.html">Invoice</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#12598</td>
                                                <td>John Doe</td>
                                                <td>Cash</td>
                                                <td>$4,099</td>
                                                <td>24 Nov, 2024 3:59 PM</td>
                                                <td><span class="status-badge status-warning">Pending</span></td>
                                                <td class="d-flex justify-content-between">
                                                    <div class="mb-2 w-75">
                                                        <select class="form-select form-select-sm border bg-light text-secondary rounded" aria-label="Order Status">
                                                            <option value="status" selected>Pending</option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Processing">Processing</option>
                                                            <option value="Cancel">Cancel</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown w-25">
                                                        <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item py-2" href="#">View</a></li>
                                                            <li><a class="dropdown-item py-2" href="invoice.html">Invoice</a></li>
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

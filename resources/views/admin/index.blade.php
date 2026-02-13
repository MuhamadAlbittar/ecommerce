@extends('admin.layouts.app')
@section('content')
<div class="main-content">
                <div class="extra-header"></div>
                <div class="card-service-section px-0 px-md-0 px-lg-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-4 col-xxl-4 col-lg-6 col-sm-6 mb-3">
                                <div class="card shadow-sm border-0 border-radius-12">
                                    <div class="card-body p-4">
                                        <div class="row">
                                                <div class="col-10">
                                                    <h6 class="text-muted mb-2">Today's Revenue</h6>
                                                    <h3 class="fw-bold">₹15,00,000</h3>
                                                    <div class="d-flex align-items-center">
                                                        <span class="status-badge status-success">
                                                            <i class="fa-solid fa-arrow-up"></i> 4.8%
                                                        </span>
                                                        <span class="text-muted ms-2">from yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center">
                                                    <i class="fa-solid fa-arrow-up-right-dots size-2 text-success"></i>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4 col-lg-6 col-sm-6  mb-3">
                                <div class="card shadow-sm border-0 border-radius-12">
                                    <div class="card-body p-4">
                                        <div class="row">
                                                <div class="col-10">
                                                    <h6 class="text-muted mb-2">Today's Orders</h6>
                                                    <h3 class="fw-bold">7,506</h3>
                                                    <div class="d-flex align-items-center">
                                                    <span class="status-badge status-danger">
                                                        <i class="fa-solid fa-arrow-down"></i> 4.8%
                                                    </span>
                                                    <span class="text-muted ms-2">from yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center ">
                                                    <i class="fa-solid fa-cart-plus size-2-5 text-success"></i>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4 col-lg-6 col-sm-6  mb-3">
                                <div class="card shadow-sm border-0 border-radius-12">
                                    <div class="card-body p-4">
                                        <div class="row">
                                                <div class="col-10">
                                                    <h6 class="text-muted mb-2">Today's Visitors</h6>
                                                    <h3 class="fw-bold">36,524</h3>
                                                    <div class="d-flex align-items-center">
                                                    <span class="status-badge status-success">
                                                        <i class="fa-solid fa-arrow-up"></i> 4.8%
                                                    </span>
                                                    <span class="text-muted ms-2">from yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center ">
                                                    <i class="fa-solid fa-street-view size-2-5 text-success"></i>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-section px-0 px-md-0 px-lg-3">
                    <div class="container-fluid mt-4">
                        <div class="row">
                                <div class="col-12 col-lg-8 mb-4">
                                <div class="card shadow-sm border-0 border-radius-12">
                                    <div class="card-body p-4">
                                            <div class="mb-3">
                                            <h5 class="fw-bold">Sales Analytics</h5>
                                            </div>
                                        <canvas id="LineChart" class="chart-content"></canvas>
                                    </div>
                                </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                <div class="card shadow-sm border-0 border-radius-12">
                                    <div class="card-body p-4">
                                            <div class="mb-3">
                                            <h5 class="fw-bold">Returns</h5>
                                            </div>
                                        <canvas id="BarChart" class="chart-content"></canvas>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="product-section px-0 px-md-0 px-lg-3">
                    <div class="container mt-5">
                        <div class="card shadow-sm border-0 border-radius-12">
                            <div class="card-body p-4">
                                <div class="row align-items-center mb-3">
                                    <!-- Title -->
                                    <div class="col-12 col-md-auto mb-3 mb-md-0">
                                        <h5 class="fw-bold text-start text-md-start">Best Selling Products</h5>
                                    </div>
                                    <!-- Filters and Sort -->
                                    <div class="col-12 col-md d-flex justify-content-end flex-wrap gap-2">
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
                                        <!-- Sort Dropdown -->
                                        <div class="dropdown">
                                            <a class="nav-link custom-bg-primary text-white rounded px-3 py-2" href="#" id="SortMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Sort By: Relevance <i class="fa-solid fa-arrow-up-wide-short"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="SortMenuLink">
                                                <li><a class="dropdown-item py-2" href="#">Low to High</a></li>
                                                <li><a class="dropdown-item py-2" href="#">High to Low</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="py-3">Product ID</th>
                                            <th scope="col" class="py-3">Image</th>
                                            <th scope="col" class="py-3">Product Name</th>
                                            <th scope="col" class="py-3">Price</th>
                                            <th scope="col" class="py-3">Total Sales</th>
                                            <th scope="col" class="py-3">Stock</th>
                                            <th scope="col" class="py-3">Status</th>
                                            <th scope="col" class="py-3">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#12598</td>
                                            <td><img src="./assets/images/p1.jfif" alt="Product Image" class="p-img-thumbnail"></td>
                                            <td>Off-white shoulder wide...</td>
                                            <td>₹4,099</td>
                                            <td>1246</td>
                                            <td>25</td>
                                            <td><span class="status-badge status-success">In Stock</span></td>
                                            <td>
                                                <a href="#" class="btn btn-sm"><i class="fa-solid fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#12598</td>
                                            <td><img src="./assets/images/p2.jfif" alt="Product Image" class="p-img-thumbnail"></td>
                                            <td>Green Velvet semi-sleeve...</td>
                                            <td>₹4,099</td>
                                            <td>1246</td>
                                            <td>25</td>
                                            <td><span class="status-badge status-danger">Out of Stock</span></td>
                                            <td>
                                                <a href="#" class="btn btn-sm"><i class="fa-solid fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#12598</td>
                                            <td><img src="./assets/images/p3.jfif" alt="Product Image" class="p-img-thumbnail"></td>
                                            <td>Nike air max 2099</td>
                                            <td>₹4,099</td>
                                            <td>1246</td>
                                            <td>25</td>
                                            <td><span class="status-badge status-info">Restock</span></td>
                                            <td>
                                                <a href="#" class="btn btn-sm"><i class="fa-solid fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
@endsection

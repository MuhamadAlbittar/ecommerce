@extends('layouts.app')
@section('content')
<div class="main-content">
                <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
                    <div class="container">
                         <div class="row">
                               <div class="col-lg-7">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center mb-3">
                                                <!-- Title -->
                                                <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                                    <h5 class="fw-bold text-start text-md-start">All items</h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="py-3">Name</th>
                                                            <th scope="col" class="py-3">Quantity</th>
                                                            <th scope="col" class="py-3">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><img src="./assets/images/p1.jfif" alt="Product Image" class="p-img-thumbnail"> <span class="ms-2">Blue denim jacket</span></td>
                                                            <td>12</td>
                                                            <td>$4,099</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center mb-3">
                                                <!-- Title -->
                                                <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                                    <h5 class="fw-bold text-start text-md-start">Cart Totals</h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col" class="text-uppercas">Title</th>
                                                      <th scope="col" class="text-uppercase">Price</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody class="table-group-divider">
                                                    <tr>
                                                      <td>Subtotal</td>
                                                      <td>$362</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Tax (5%)</td>
                                                      <td>$18.1</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Shipping</td>
                                                      <td>$15</td>
                                                    </tr>
                                                    <tr>
                                                      <th class="text-uppercase">Total</th>
                                                      <td class="text-danger fw-bold ">$495.1</td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                        </div>
                                    </div>
                               </div>
                               <div class="col-lg-5">
                                <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center mb-3">
                                            <!-- Title -->
                                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                                <h5 class="fw-bold text-start text-md-start">Summary</h5>
                                            </div>
                                        </div>
                                        <div>
                                            <table>
                                                <tr>
                                                    <td width="50%">Order ID:</td>
                                                    <td width="50%"><b>#192847</b></td>
                                                </tr>
                                                <tr>
                                                    <td width="50%">Date:</td>
                                                    <td width="50%"><b>20 Nov 2023</b></td>
                                                </tr>
                                                <tr>
                                                    <td width="50%">Total:</td>
                                                    <td width="50%"><b>$50</b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center mb-3">
                                            <!-- Title -->
                                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                                <h5 class="fw-bold text-start text-md-start">Shipping Address</h5>
                                            </div>
                                        </div>
                                        <div>
                                            <p>1234 Elm Street San Francisco, California, 94101 United States</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center mb-3">
                                            <!-- Title -->
                                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                                <h5 class="fw-bold text-start text-md-start">Payment Method</h5>
                                            </div>
                                        </div>
                                        <div>
                                            <p>Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking acceptance subject to device availability.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center mb-3">
                                            <!-- Title -->
                                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                                <h5 class="fw-bold text-start text-md-start">Expected Date Of Delivery</h5>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-success">20 Nov 2023</p>
                                            <a  href="javascript:void(0)" class="btn text-primary border-color hover-bg-primary w-100"><i class="fa-solid fa-truck-fast"></i> Track order</a>
                                        </div>
                                    </div>
                                </div>
                               </div>
                         </div>

                    </div>
                </div>
           </div>
@endsection

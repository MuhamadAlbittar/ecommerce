@extends('layouts.app')
@section('content')
<div class="main-content">
                <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
                    <div class="container">
                        <div class="card shadow-sm border-0 border-radius-12" id="invoice-section">
                            <div class="card-body p-4">
                                <div class="invoice mt-5">
                                            <div class="invoice-box">
                                                <div class="invoice-header d-flex justify-content-between ">
                                                  <a class="pt-2 d-inline-block bg-success-color p-2" href="#" data-abc="true">
                                                    <img src="./assets/images/logo.png" alt="logo large">
                                                  </a>
                                                    <div class="float-right">
                                                        <h3 class="mb-0 invoice-no">Invoice #BBB1</h3>
                                                       <span class="d-block invoice-date">Date: 12 Jun,2019</span>
                                                   </div>
                                                </div>
                                                <div class="invoice-body">
                                                    <div class="row mb-4 d-flex">
                                                        <div class="col-sm-6 invoice-adds">
                                                            <h5 class="mb-2">From:</h5>
                                                            <address>
                                                                <strong>TemplateRise</strong><br>
                                                                1234 Elm Street<br>
                                                                San Francisco, California, 94101<br>
                                                                United States<br>
                                                                Phone: (415) 555-1234<br>
                                                                Email: contact@domain.com
                                                              </address>
                                                        </div>
                                                        <div class="col-sm-6 text-right d-flex justify-content-end invoice-adds">
                                                             <div class="">
                                                                <h5 class="mb-2">To:</h5>
                                                                <address>
                                                                    <strong>Jordan Mitchell</strong><br>
                                                                    4321 Maple Avenue<br>
                                                                    Denver, Colorado, 80202<br>
                                                                    United States<br>
                                                                    Phone: (303) 555-6789<br>
                                                                    Email: jmitchell@company.com
                                                                </address>
                                                             </div>
                                                        </div>

                                                     </div>
                                                            <div class="table-responsive-sm">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Product</th>
                                                                            <th>Quntity</th>
                                                                            <th>Tax</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>123456</td>
                                                                            <td>Blue denim jacket</td>
                                                                            <td>1</td>
                                                                            <td>10</td>
                                                                            <td>$15,000</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-sm-5">
                                                                    </div>
                                                                    <div class="col-lg-4 col-sm-5 ms-auto">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="left">
                                                                                        <strong class="text-dark">Subtotal</strong>
                                                                                    </td>
                                                                                    <td class="right">$28,809,00</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="left">
                                                                                        <strong class="text-dark">Discount (20%)</strong>
                                                                                    </td>
                                                                                    <td class="right">$5,761,00</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="left">
                                                                                        <strong class="text-dark">VAT (10%)</strong>
                                                                                    </td>
                                                                                    <td class="right">$2,304,00</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="left">
                                                                                        <strong class="text-dark">Total</strong> </td>
                                                                                    <td class="right">
                                                                                        <strong class="text-dark">$20,744,00</strong>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                                <hr>
                                                <div class="invoice-footer">
                                                    <p class="mb-0">Notice: </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-end">
                                                    <a  href="javascript:void(0)" class="btn text-primary border-color hover-bg-primary me-2" id="printInvoice"><i class="fa-solid fa-print"></i> Print</a>
                                                    <button type="submit" class="btn custom-bg-primary text-white btn-hover"><i class="fa-solid fa-download"></i> Download</button>
                                                </div>
                                              </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>

@endsection

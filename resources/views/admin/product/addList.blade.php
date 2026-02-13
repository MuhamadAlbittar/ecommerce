@extends('admin.layouts.app')
@section('content')
<div class="main-content">
                <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
                    <div class="container">
                         <form method="get">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-header bg-white pt-3">
                                            <h5 class="fw-normal text-start">Product information</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                    <label for="inputName" class="form-label">Name </label>
                                                    <input type="text" class="form-control" id="inputName">
                                                    </div>
                                                    <div class="col-md-6">
                                                    <label for="inputProductID" class="form-label">Product ID</label>
                                                    <input type="text" class="form-control" id="inputProductID">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputSku" class="form-label">SKU</label>
                                                        <input type="text" class="form-control" id="inputSku">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputName" class="form-label">Vendor</label>
                                                        <input type="text" class="form-control" id="inputName">
                                                    </div>

                                                    <div class="col-12">
                                                    <label for="editor" class="form-label">Description</label>
                                                    <textarea id="editor" class="form-control" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-header bg-white pt-3">
                                            <h5 class="fw-normal text-start">Media</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="file-upload-container">
                                                <div id="dropzone" class="dropzone">
                                                <div class="icon">
                                                    <svg width="90" height="90" viewBox="0 0 105 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_12_2806)">
                                                        <path d="M53.498 65.0693L15.9733 66.6661" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M53.8972 65.0693L103.398 69.4605" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M103.797 69.4607L93.8171 115.768" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M93.8171 115.768L52.6996 122.953" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M52.6996 122.554V73.4526" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M52.6996 73.8519L103.398 69.8599" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M52.6996 73.8518L15.9733 66.6663" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M15.1749 66.6663L17.5701 103.393" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M17.5701 103.393L52.6996 122.953" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M53.0988 65.0693V73.0533" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M82.5997 84.2736L74.5341 84.7725C72.6636 84.8882 71.2411 86.4982 71.3568 88.3687L71.4306 89.5624C71.5463 91.4328 73.1564 92.8553 75.0268 92.7396L83.0924 92.2408C84.9629 92.1251 86.3854 90.515 86.2697 88.6446L86.1958 87.4509C86.0802 85.5804 84.4701 84.1579 82.5997 84.2736Z" stroke="black" stroke-width="1.1976"/>
                                                        <path d="M1.20294 11.9761C8.24038 23.1729 27.476 44.381 48.1192 39.6388L77.0507 18.299" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M1.20294 11.9759L33.9372 1.19751" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M33.9373 1.19751C40.0777 6.78629 57.2968 17.9639 77.0507 17.9639" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M19.5661 17.5646C22.4048 16.8993 28.934 14.7703 32.3405 11.5767" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M27.9493 24.7503C29.7235 24.3511 33.8042 22.8342 35.9333 19.96" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M37.53 29.94C39.7922 29.5408 45.7535 27.7045 48.3084 21.9561" stroke="black" stroke-width="1.99599" stroke-linecap="round"/>
                                                        <path d="M52.4126 133.332L16.5721 103.991L52.5 123.951L94.8151 116.566L98.8071 117.165L52.4126 133.332Z" fill="#21325B" fill-opacity="0.3"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_12_2806">
                                                        <rect width="104.989" height="134.53" fill="white" transform="translate(0.00537109)"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <p>Drag and drop your file here</p>
                                                <p>or</p>
                                                <a href="javascript:void(0)" id="browseButton">Browse files</a>
                                                <input id="fileInput" type="file" multiple hidden />
                                                </div>
                                                <div id="preview" class="preview-grid"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-header bg-white pt-3">
                                            <h5 class="fw-normal text-start">Pricing</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div>
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                    <label for="inputName" class="form-label">Actual Price</label>
                                                    <input type="text" class="form-control" id="inputName">
                                                    </div>
                                                    <div class="col-md-12">
                                                    <label for="inputProductID" class="form-label">Sale Price</label>
                                                    <input type="text" class="form-control" id="inputProductID">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-header bg-white pt-3">
                                            <h5 class="fw-normal text-start">Organization</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div>
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <label for="inputCategory" class="form-label">Category</label>
                                                        <select id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputTags" class="form-label">Tags</label>
                                                        <input type="text" class="form-control" id="inputTags"  placeholder="Enter tags here">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-header bg-white pt-3 d-flex justify-content-between align-items-center">
                                            <h5 class="fw-normal text-start">Variants</h5>
                                            <a href="javascript:void(0)" class="btn text-primary border-color hover-bg-primary" id="add-variant"><i class="fas fa-plus"></i> Add Variant</a>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="table-light">
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Size</th>
                                                        <th>Color</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="variants-table">
                                                    <!-- Rows will be dynamically added here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 offset-lg-3">
                                    <div class="card shadow-sm border-0 border-radius-12 mb-4">
                                        <div class="card-body p-4 d-flex">
                                            <a  href="javascript:void(0)" class="btn text-primary border-color hover-bg-primary w-50 me-2"> Discard</a>
                                            <button type="submit" class="btn custom-bg-primary w-50 text-white btn-hover">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
           </div>
@endsection

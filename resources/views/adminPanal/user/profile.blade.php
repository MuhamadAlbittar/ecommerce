@extends('layouts.app')
@section('content')
 <div class="main-content">
                <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
                    <div class="container">
                        <div class="card shadow-sm border-0 border-radius-12">
                            <div class="card-body p-4">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="accountTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active text-primary" id="account-tab" data-bs-toggle="tab"
                                        data-bs-target="#account" type="button" role="tab" aria-controls="account"
                                        aria-selected="true">
                                        <i class="bi bi-person"></i> Account
                                    </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link text-primary" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">
                                        <i class="bi bi-person-circle"></i> Profile
                                    </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link text-primary" id="password-tab" data-bs-toggle="tab"
                                        data-bs-target="#password" type="button" role="tab"
                                        aria-controls="password" aria-selected="false">
                                        <i class="bi bi-lock"></i> Change Password
                                    </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content mt-4">
                                    <div class="tab-pane fade show active" id="account" role="tabpanel"
                                    aria-labelledby="account-tab">
                                    <h5 class="h5 mb-5">Account Info</h5>
                                    <form>
                                        <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" value="Admin">
                                        </div>
                                        <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            value="admin@example.com">
                                        </div>
                                        <button type="submit" class="btn custom-bg-primary text-white btn-hover">Save</button>
                                    </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <h5 class="h5 mb-5">Change profile image</h5>
                                    <form>
                                        <div class="profile-pic-wrapper">
                                            <div class="pic-holder">
                                                <!-- uploaded pic shown here -->
                                                <img id="profilePic" class="pic" src="./assets/images/profile.png">
                                                <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                                                <label for="newProfilePhoto" class="upload-file-block">
                                                  <div class="text-center">
                                                    <div class="mb-2">
                                                      <i class="fa fa-camera fa-2x"></i>
                                                    </div>
                                                    <div class="text-uppercase">
                                                      Update <br /> Profile Photo
                                                    </div>
                                                  </div>
                                                </label>
                                              </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel"
                                    aria-labelledby="password-tab">
                                    <h5 class="h5 mb-5">Change Password</h5>
                                    <form>
                                        <div class="mb-3">
                                        <label for="OldPassword" class="form-label">Old Password</label>
                                        <input type="password" class="form-control" id="OldPassword">
                                        </div>
                                        <div class="mb-3">
                                            <label for="NewPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="NewPassword">
                                        </div>
                                        <div class="mb-3">
                                            <label for="NewConfirmPassword" class="form-label">New Confirm Password</label>
                                            <input type="password" class="form-control" id="NewConfirmPassword">
                                        </div>
                                        <button type="submit" class="btn custom-bg-primary text-white btn-hover">Save</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
@endsection

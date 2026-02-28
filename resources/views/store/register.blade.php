@extends('store.layouts.app')

@section('content')

<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left side text -->
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Already have an account?</h2>
                        <p>Log in to access your orders, wishlist, and more.</p>
                        <a href="{{ route('login') }}" class="btn_3">Login Now</a>
                    </div>
                </div>
            </div>

            <!-- Register form -->
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Create Your Account <br> Join us today</h3>

                        <form class="row contact_form" 
                              action="{{ route('register') }}" 
                              method="POST" 
                              novalidate="novalidate">
                            
                            @csrf

                            <div class="col-md-12 form-group p_star">
                                <input type="text" 
                                       class="form-control" 
                                       name="name" 
                                       placeholder="Full Name"
                                       value="{{ old('name') }}">
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="email" 
                                       class="form-control" 
                                       name="email" 
                                       placeholder="Email Address"
                                       value="{{ old('email') }}">
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="password" 
                                       class="form-control" 
                                       name="password" 
                                       placeholder="Password">
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="password" 
                                       class="form-control" 
                                       name="password_confirmation" 
                                       placeholder="Confirm Password">
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn_3">
                                    Create Account
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

{{-- <!-- breadcrumb start-->
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Register</h2>
                            <p>Home <span>-</span> Register</p> --}}
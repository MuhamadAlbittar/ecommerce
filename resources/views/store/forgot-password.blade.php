@extends('store.layouts.app')

@section('content')

<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left side text -->
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Forgot your password?</h2>
                        <p>No worries! Enter your email and we’ll send you a reset link.</p>
                        <a href="{{ route('login') }}" class="btn_3">Back to Login</a>
                    </div>
                </div>
            </div>

            <!-- Forgot Password Form -->
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Reset Your Password</h3>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="row contact_form" 
                              method="POST" 
                              action="{{ route('password.email') }}" 
                              novalidate="novalidate">

                            @csrf

                            <!-- Email -->
                            <div class="col-md-12 form-group p_star">
                                <input type="email" 
                                       class="form-control" 
                                       name="email" 
                                       placeholder="Email Address"
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn_3">
                                    Send Password Reset Link
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
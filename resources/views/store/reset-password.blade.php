@extends('store.layouts.app')

@section('content')

<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left side text -->
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Reset your password</h2>
                        <p>Enter your new password below to regain access to your account.</p>
                        <a href="{{ route('login') }}" class="btn_3">Back to Login</a>
                    </div>
                </div>
            </div>

            <!-- Reset Password Form -->
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Create a New Password</h3>

                        <form class="row contact_form"
                              method="POST"
                              action="{{ route('password.store') }}"
                              novalidate="novalidate">

                            @csrf

                            <!-- Hidden Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email -->
                            <div class="col-md-12 form-group p_star">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       placeholder="Email Address"
                                       value="{{ old('email', $request->email) }}"
                                       required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="col-md-12 form-group p_star">
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="New Password"
                                       required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-12 form-group p_star">
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       placeholder="Confirm New Password"
                                       required>
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn_3">
                                    Reset Password
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
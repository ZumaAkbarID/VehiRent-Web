@extends('Layouts.Auth.auth')
@section('auth')
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="/assets/auth/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="/assets/auth/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Register your account</p>
              @include('Partials.alert')
              <form action="{{ route('registerProcess') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required value="{{ old('name') }}">
                  </div>
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required value="{{ old('email') }}">
                  </div>
                  <div class="form-group">
                    <label for="phone_number" class="sr-only">Phone Number</label>
                    <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Phone number" required value="{{ old('phone_number') }}">
                  </div>
                  <div class="form-group">
                    <label for="address" class="sr-only">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" required value="{{ old('address') }}">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                  </div>
                  <button type="submit" class="btn btn-block login-btn mb-4">Register</button>
                </form>
                <a href="{{ route('reset-password') }}" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Already have an account? <a href="{{ route('login') }}" class="text-reset">Login here</a></p>
                <nav class="login-card-footer-nav">
                  <a href="#!">Terms of use.</a>
                  <a href="#!">Privacy policy</a>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
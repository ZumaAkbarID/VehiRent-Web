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
              <p class="login-card-description">Sign into your account</p>
              @include('Partials.alert')
              <form action="{{ route('loginProcess') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="auth" class="sr-only">Email/Phone Number</label>
                    <input type="text" name="auth" id="auth" class="form-control" placeholder="Email address or Phone Number" value="{{ old('auth') }}" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
                  </div>
                  <button type="submit" class="btn btn-block login-btn mb-4">Login</button>
                </form>
                <a href="{{ route('reset-password') }}" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
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
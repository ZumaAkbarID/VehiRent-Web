@extends('Layouts.Auth.auth')
@section('auth')
  @include('Partials.alert')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="/" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="/assets/icon.png" alt="" width="150">
                </span>
                {{-- <span class="fs-2 text-body fw-bolder">{{ config('app.name') }}</span> --}}
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to {{ config('app.name') }}! 👋</h4>
            <p class="mb-4">Please sign-in to your account</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('loginProcess') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="auth" class="form-label">Email or Phone Number</label>
                <input
                  type="text"
                  class="form-control"
                  id="auth"
                  name="auth"
                  placeholder="Enter your email or phone number"
                  autofocus
                  required
                  value="{{ old('auth') }}"
                />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="{{ route('reset-password') }}">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    required
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>

            <p class="text-center">
              <span>New on our platform?</span>
              <a href="{{ route('register') }}">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
@endsection
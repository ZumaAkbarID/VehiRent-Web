@extends('Layouts.Auth.auth')
@section('auth')
  @include('Partials.alert')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
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
            <h4 class="mb-2">Create New Password</h4>
            <p class="mb-4">Make sure you create a password that is safe and easy to remember!</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('save-password') }}" method="POST">
            @csrf
            <input type="hidden" name="tkn" value="{{ $token }}">
              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  placeholder="Enter your new password"
                  autofocus required
                />
              </div>
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input
                  type="password"
                  class="form-control"
                  id="password_confirmation"
                  name="password_confirmation"
                  placeholder="Confirm your password"
                  autofocus required
                />
              </div>
              <button class="btn btn-primary d-grid w-100" type="submit">Save New Password</button>
            </form>
            <div class="text-center">
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>
@endsection
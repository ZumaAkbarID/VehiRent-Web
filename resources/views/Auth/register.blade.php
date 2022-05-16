@extends('Layouts.Auth.auth')
@section('auth')
@include('Partials.alert')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
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

            <form id="formAuthentication" class="mb-3" action="{{ route('registerProcess') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required value="{{ old('name') }}">
              </div>
              <div class="form-group mb-3">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required value="{{ old('email') }}">
              </div>
              <div class="form-group mb-3">
                <label for="phone_number" class="sr-only">Phone Number</label>
                <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Phone number" required value="{{ old('phone_number') }}">
              </div>
              <div class="form-group mb-3">
                <label for="address" class="sr-only">Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Address" required value="{{ old('address') }}">
              </div>
              <div class="form-group mb-3">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
              </div>
              <div class="form-group mb-3">
                <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
              </div>

              {{-- <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required/>
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div> --}}
              <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
            </form>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{ route('login') }}">
                <span>Sign in instead</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>
@endsection
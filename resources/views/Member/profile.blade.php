@extends('Layouts.Dashboard.dashboard')
@section('dashboard')    
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Account</h4>
<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
      </li>
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Account -->
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('saveProfile') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img
            src="{{ asset('/storage/'.auth()->user()->avatar) }}"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar"
            name="uploadedAvatar"
          />
          <input type="hidden" name="oldImage" value="{{ auth()->user()->avatar }}">
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input
                type="file"
                id="upload"
                name="upload"
                class="account-file-input"
                hidden
                accept="image/png, image/jpeg, image/gif"
              />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max file 2MB. Better Aspec Ratio 1:1</p>
              </div>
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="name" class="form-label">Full Name</label>
                  <input
                    class="form-control"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ auth()->user()->name }}"
                    autofocus
                    required
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="email" name="email" id="email" value="{{ auth()->user()->email }}" required/>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <input
                    class="form-control"
                    type="text"
                    id="address"
                    name="address"
                    value="{{ auth()->user()->address }}" required
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="role" class="form-label">Role</label>
                  <input
                    type="text"
                    class="form-control"
                    id="role"
                    value="{{ auth()->user()->role }}"
                    readonly
                  />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="phone_number">Phone Number</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">ID </span>
                    <input
                      type="number"
                      id="phone_number"
                      name="phone_number"
                      class="form-control"
                      placeholder="081225389xxx"
                      value="{{ auth()->user()->phone_number }}"
                      required
                    />
                  </div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password" required/>
                </div>
              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
              </div>
          </div>
          <!-- /Account -->
        </div>
      </form>
        <div class="card">
          <h5 class="card-header">Change Password</h5>
          <div class="card-body">
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to change password?</h6>
                {{-- <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p> --}}
              </div>
            </div>
            <form id="formAccountDeactivation" method="POST" action="{{ route('saveLogin') }}">
              @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input class="form-control" type="password" name="current_password" id="current_password" placeholder="Curent Password" required/>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="new_password" class="form-label">New Password</label>
                  <input class="form-control" type="password" name="new_password" id="new_password" placeholder="*********" required/>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                  <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password" placeholder="**********" required/>
                </div>
              </div>
              <div class="form-check mb-3">
                <input
                  class="form-check-input"
                  type="checkbox"
                  name="accountActivation"
                  id="accountActivation"
                  required
                />
                <label class="form-check-label" for="accountActivation"
                  >I confirm to change my password</label
                >
              </div>
              <button type="submit" class="btn btn-danger deactivate-account">Change Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
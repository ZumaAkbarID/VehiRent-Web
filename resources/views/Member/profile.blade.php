@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/main/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Dashboard <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Profile</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container">
      <div class="col-lg-12">
          <div class="row">
              <div class="col-lg-3 mb-4">
                <div class="list-group">
                  <a href="{{ route('redirects') }}" class="list-group-item list-group-item-action">Dashboard</a>
                  <a href="{{ route('profileMember') }}" class="list-group-item list-group-item-action active">Profile</a>
                  <a href="{{ route('historyMember') }}" class="list-group-item list-group-item-action">History</a>
                </div>
              </div>
              <div class="col-lg-9">
                  
                  <h4>Profile</h4>
                  <button type="button" class="btn btn-secondary my-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    Edit Profile
                  </button>

                  <table>
                      <tr>
                          <td>Name</td>
                          <td> : {{ $user->name }}</td>
                      </tr>
                      <tr>
                          <td>Email</td>
                          <td> : {{ $user->email }}</td>
                      </tr>
                      <tr>
                          <td>Phone Number</td>
                          <td> : {{ $user->phone_number }}</td>
                      </tr>
                      <tr>
                          <td>Address</td>
                          <td> : {{ $user->address }}</td>
                      </tr>
                  </table>
                  
                  <div class="col-lg-12 mt-4">
                    <div class="row">
                      
                      <div class="col-lg-6 mb-4">
                        <h6 class="border-bottom text-black">Login Details <button type="button" class="btn btn-secondary my-2" data-bs-toggle="modal" data-bs-target="#editLoginModal">Edit Login</button></h6>
                        <ul class="list-unstyled">
                          <li>{{ $user->email }} or {{ $user->phone_number }}</li>
                          <li>*****</li>
                        </ul>
                      </div>

                    </div>
                  </div>

              </div>
          </div>
      </div>
    </div>
  </section>

  @include('Partials.alert')

  <!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('saveProfileMember') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" value="{{ $user->phone_number }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ $user->address }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password Confirmation</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editLoginModal" tabindex="-1" aria-labelledby="editLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Login Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('saveLoginMember') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New</label>
                <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Confirm New Password" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/main/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span></p>
          <h1 class="mb-3 bread">Dashboard</h1>
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
                  <a href="{{ route('redirects') }}" class="list-group-item list-group-item-action active">Dashboard</a>
                  <a href="{{ route('profileMember') }}" class="list-group-item list-group-item-action">Profile</a>
                  <a href="{{ route('historyMember') }}" class="list-group-item list-group-item-action">History</a>
                </div>
              </div>
              <div class="col-lg-9">
                  <h2 class="border-bottom"><b>My Dashboard</b></h2>
                  <h5>Hello, <b>{{ $user->name }}</b></h5>
                  <p class="text-small mb-3">From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>

                  <div class="col-lg-12">
                    <div class="row">

                      <div class="col-lg-4 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title text-center">Total Rental</h5>
                            <p class="card-text text-center text-black"><b>12</b></p>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title text-center">On Progress</h5>
                            <p class="card-text text-center text-black"><b>5</b></p>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title text-center">Canceled</h5>
                            <p class="card-text text-center text-black"><b>34</b></p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <h4>Account Information</h4>
                  <div class="col-lg-12">
                    <div class="row">
                      
                      <div class="col-lg-6 mb-4">
                        <h6 class="border-bottom text-black">Contact Information</h6>
                        <ul class="list-unstyled">
                          <li>{{ $user->name }}</li>
                          <li>{{ $user->email }}</li>
                          <li>{{ $user->phone_number }}</li>
                        </ul>
                      </div>

                    </div>
                  </div>

              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
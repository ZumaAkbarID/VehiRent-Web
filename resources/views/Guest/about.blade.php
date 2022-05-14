@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/main/images/ferrari.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">About Us</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-about">
          <div class="container">
              <div class="row no-gutters">
                  <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(assets/main/images/aboutus.jpg);">
                  </div>
                  <div class="col-md-6 wrap-about ftco-animate">
            <div class="heading-section heading-section-white pl-md-5">
                <span class="subheading">About us</span>
              <h2 class="mb-4">Welcome to {{ config('app.name') }}</h2>

              <p>{{ config('app.name') }} since 2022 specializing in the rental of cars, motorcyle, bicyle and commercial vehicles in The Java. With offices in The Jepara and Krasak, {{ config('app.name') }} is one of the larger rental companies in the region. For both individuals and companies {{ config('app.name') }} offers a solution for almost all (temporary) traffic requirements.</p>
              <p><a href="/rental" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
            </div>
                  </div>
              </div>
          </div>
      </section>

  @include('Layouts.Guest.experience')
@endsection
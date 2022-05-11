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
              <h2 class="mb-4">Welcome to Carbook</h2>

              <p>SoF Rental since 2022 specializing in the rental of cars, motorcyle, bicyle and commercial vehicles in The Java. With offices in The Jepara and Krasak, SoF Rental is one of the larger rental companies in the region. For both individuals and companies SoF Rental offers a solution for almost all (temporary) traffic requirements.</p>
              <p><a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
            </div>
                  </div>
              </div>
          </div>
      </section>


  <section class="ftco-section testimony-section bg-light">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Testimonial</span>
          <h2 class="mb-3">Happy Clients</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel ftco-owl">
            <div class="item">
              <div class="testimony-wrap rounded text-center py-4 pb-5">
                <div class="user-img mb-2" style="background-image: url(assets/main/images/gilang.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">Mantap admin ramah, service cepat, dan harga murah</p>
                  <p class="name">Gilang</p>
                  <span class="position">Pemain arknight</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap rounded text-center py-4 pb-5">
                <div class="user-img mb-2" style="background-image: url(assets/main/images/Toriq.jpeg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">Harga mantap, penanganan cepat, mobil mulus</p>
                  <p class="name">Torik</p>
                  <span class="position">Tukang gambar</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap rounded text-center py-4 pb-5">
                <div class="user-img mb-2" style="background-image: url(assets/main/images/zuma.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">Kendaraan sesuai dan mulus</p>
                  <p class="name">Zooma</p>
                  <span class="position">Proplayer Valo</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap rounded text-center py-4 pb-5">
                <div class="user-img mb-2" style="background-image: url(assets/main/images/pito.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">CS ramah, ada kendala sedikit langsung selesai, harga mantap</p>
                  <p class="name">Pito</p>
                  <span class="position">Melers</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap rounded text-center py-4 pb-5">
                <div class="user-img mb-2" style="background-image: url(assets/main/images/dimas.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">A mimir</p>
                  <p class="name">Dimas</p>
                  <span class="position">Tukang Musik</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('Layouts.Guest.experience')
@endsection
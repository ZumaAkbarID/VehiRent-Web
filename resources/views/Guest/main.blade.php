@extends('Layouts.Guest.default')

@section('content')
<div class="hero-wrap ftco-degree-bg" style="background-image: url('assets/main/images/ferrari.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
        <div class="col-lg-8 ftco-animate">
            <div class="text w-100 text-center mb-md-5 pb-md-5">
              <h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
              <p style="font-size: 18px;">Source of fortune for everyone</p>
              <a href="https://www.youtube.com/watch?v=V_Gb83pGhe0" class="icon-wrap popup-youtube d-flex align-items-center mt-4 justify-content-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                      <span class="ion-ios-play"></span>
                  </div>
                  <div class="heading-title ml-5">
                      <span>Easy steps for renting a car</span>
                  </div>
              </a>
          </div>
        </div>
      </div>
    </div>
  </div>

   <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
          <div class="row no-gutters">
              <div class="col-md-12	featured-top">
                  <div class="row no-gutters">
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                                <div class="row d-flex mb-4">
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                              <div class="services w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                                <div class="text w-100">
                                  <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                              </div>
                              </div>      
                            </div>
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                              <div class="services w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                <div class="text w-100">
                                  <h3 class="heading mb-2">Select the Best Deal</h3>
                                </div>
                              </div>      
                            </div>
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                              <div class="services w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                <div class="text w-100">
                                  <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                </div>
                              </div>      
                            </div>
                          </div>
                            </div>
                        </div>
                    </div>
              </div>
        </div>
  </section>


  <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
          <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
            <span class="subheading">What we offer</span>
          <h2 class="mb-2">Feeatured Vehicles</h2>
        </div>
      </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="carousel-car owl-carousel">

                    @foreach ($featuredVehicle as $item)
                    <div class="item">
                      <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('/storage/'.$item->vehicle_image) }});">
                        </div>
                        <div class="text">
                          <h2 class="mb-0"><a href="{{ route('vehicleSingle', $item->vehicle_slug) }}">{{ $item->vehicle_name }}</a></h2>
                          <div class="d-flex mb-3">
                            <span class="cat">{{ $item->brand->brand_name }}</span>
                            <p class="price ml-auto">Rp.{{ number_format($item->rent_price, 2, ',', '.') }} <span>/day</span></p>
                          </div>
                          <p class="d-flex mb-0 d-block"><a href="{{ route('rentalNow', $item->vehicle_slug) }}" class="btn btn-primary py-2 mr-1">Book now</a> <a href="{{ route('vehicleSingle', $item->vehicle_slug) }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
                        </div>
                      </div>
                    </div>
                    @endforeach
                      
                  </div>
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
              <h2 class="mb-4">Welcome to Source of Fortune</h2>

              <p>SoF Rental since 2020 specializing in the rental of cars, motorcyle, bicyle and commercial vehicles in The Java. With offices in The Jepara and Krasak, SoF Rental is one of the larger rental companies in the region. For both individuals and companies SoF Rental offers a solution for almost all (temporary) traffic requirements.</p>
              <p><a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
            </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="ftco-section">
          <div class="container">
              <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Services</span>
          <h2 class="mb-3">Our Advantages</h2>
        </div>
      </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-mobile-screen text-white fs-2"></i></div>
              <div class="text w-100">
              <h3 class="heading mb-2">Practical</h3>
              <p>Transaction processing can be done anywhere and anytime.</p>
            </div>
          </div>
                  </div>
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
              <div class="text w-100">
              <h3 class="heading mb-2">Cheap</h3>
              <p>The prices we offer are very affordable so they are pocket friendly.</p>
            </div>
          </div>
                  </div>
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
              <div class="text w-100">
              <h3 class="heading mb-2">Fast</h3>
              <p>The SoF rental transaction process is very fast so it doesn't waste time.</p>
            </div>
          </div>
                  </div>
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
              <div class="text w-100">
              <h3 class="heading mb-2">Simple</h3>
              <p>UI SoF rental is very simple so it is easy to understand for all people.</p>
            </div>
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
                  <span class="position">Tukang Gambar</span>
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
                  <p class="mb-4">A Mimir</p>
                  <p class="name">Dimas</p>
                  <span class="position">Tukang musik</span>
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
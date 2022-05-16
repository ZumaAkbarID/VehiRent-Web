@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/assets/main/images/ferrari.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">{{ $vehicle->vehicle_name }}</h1>
        </div>
      </div>
    </div>
  </section>
      

      <section class="ftco-section ftco-car-details">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="car-details">
                    <div class="img rounded" style="background-image: url({{ asset('/storage/'.$vehicle->vehicle_image) }});"></div>
                    <div class="text text-center">
                        <span class="subheading">{{ $vehicle->brand->brand_name }}</span>
                        <h2>{{ $vehicle->vehicle_name }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-lock"></i></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Number Plate
                          <span>{{ $vehicle->number_plate }}</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-calendar"></i></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Vehicle Year
                          <span>{{ $vehicle->vehicle_year }}</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat text-center" style="color: gray;font-size:30px;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Seats
                          <span>{{ $vehicle->vehicle_seats }}</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-brush"></i></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Color
                          <span>{{ $vehicle->vehicle_color }}</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><i class="fa-solid fa-check"></i></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Status
                          <span>{{ $vehicle->vehicle_status }}</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        </div>
        <div class="row">
            <div class="col-md-12 pills">
                      <div class="bd-example bd-example-tabs">
                          <div class="d-flex justify-content-center">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                              <li class="nav-item">
                                <a class="nav-link active" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
                              </li>
                            </ul>
                          </div>

                        <div class="tab-content" id="pills-tabContent">

                          <div class="tab-pane fade show active" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                            {!! $vehicle->vehicle_description !!}
                          </div>

                        </div>
                        <div class="row justify-content-center">
                            @if(auth()->check() && auth()->user()->role !== 'Admin')
                            <div class="col-lg-4">
                              <a href="{{ route('rentalNow', $vehicle->vehicle_slug) }}" class="btn btn-lg btn-primary w-100 fw-bolder">Rental</a>
                          </div>   
                            @endif
                        </div>
                      </div>
            </div>
              </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt">
      <div class="container">
          <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
            <span class="subheading">Choose Car</span>
          <h2 class="mb-2">Related Cars</h2>
        </div>
      </div>
      <div class="row">

        @php
        $name = array();
        @endphp
        @foreach ($related as $item)
           @if (!in_array($item->vehicle_slug, $name) && $item->vehicle_slug !== $vehicle->vehicle_slug)
          <div class="col-md-4">
              <div class="car-wrap rounded ftco-animate">
                  <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('/storage/'.$item->vehicle_image) }});">
                  </div>
                  <div class="text">
                      <h2 class="mb-0"><a href="{{ route('vehicleSingle', $vehicle->vehicle_slug) }}">{{ $item->vehicle_name }}</a></h2>
                      <div class="d-flex mb-3">
                          <span class="cat">{{ $item->brand->brand_name }}</span>
                          <p class="price ml-auto">Rp.{{ number_format($item->rent_price,2,',','.') }} <span>/day</span></p>
                      </div>
                      <p class="d-flex mb-0 d-block"><a href="{{ route('rentalNow', $item->vehicle_slug) }}" class="btn btn-primary py-2 mr-1">Rental now</a> <a href="{{ route('vehicleSingle', $item->vehicle_slug) }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
                  </div>
              </div>
          </div>
        @php
        array_push($name,$item->vehicle_slug)
        @endphp
        @endif
        @endforeach
              
      </div>
      </div>
  </section>
@endsection
@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/main/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Dashboard <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">History</h1>
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
                  <a href="{{ route('profileMember') }}" class="list-group-item list-group-item-action">Profile</a>
                  <a href="{{ route('historyMember') }}" class="list-group-item list-group-item-action active">History</a>
                </div>
              </div>
              <div class="col-lg-9">
                  
                  <div class="box-head mb-3">
                      <h3>My Order</h3>
                  </div>
                  <div class="table">
                      <table class="table">
                          <thead>
                              <tr class="table-head">
                                  <th scope="col">Code</th>
                                  <th scope="col">Vehicle</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Detail</th>
                              </tr>
                          </thead>
                          <tbody>

                            @if (sizeof($transaction) == 0)
                                <tr>
                                  <td colspan="5" class="text-center">You don't have any history</td>
                                </tr>
                            @else
                              @foreach ($transaction as $item)
                              <tr>
                                <td>
                                  <p class="mt-0"><a href="/history/{{ $item->transaction_code }}" class="theme-color fs-6">#{{ $item->transaction_code }}</a></p>
                                </td>
                                <td>
                                  <p class="mt-0">{{ $item->vehicleSpec->vehicle_name }}</p>
                                </td>
                                <td>
                                  <p class="success-button btn btn-sm">
                                    {{ ($item->status !== 'Approved') ? 'Approved | '.$item->status : $item->status }} 
                                  </p>
                                </td>
                                <td>
                                  <p class="theme-color fs-6">Rp.{{ number_format($item->rent_price,2,',','.') }}</p>
                                </td>
                                <td>
                                  <a href="/history/{{ $item->transaction_code }}" class="theme-color fs-6">View</a>
                                </td>
                              </tr>
                              @endforeach
                            @endif
                            
                          </tbody>
                      </table>
                  </div>

              </div>
          </div>
      </div>
    </div>
  </section>

  @include('Partials.alert')
@endsection
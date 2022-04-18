@extends('Layouts.Guest.default')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/assets/main/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{ route('redirects') }}">Dashboard <i class="ion-ios-arrow-forward"></i></a></span> <span>History <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">#{{ $transaction->transaction_code }}</h1>
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
                      <h3>History Details | <a href="{{ route('historyMember') }}"><small style="font-size: 15px">Back</small></a></h3>
                  </div>
                  
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="p-3">Transaction Code</td>
                        <td class="p-3">#{{ $transaction->transaction_code }}</td>
                      </tr>
                      <tr>
                        <td class="p-3">Vehicle Brand</td>
                        <td class="p-3"><a href="/brand/{{ $brand->brand_slug }}">{{ $brand->brand_name }}</a></td>
                      </tr>
                      <tr>
                        <td class="p-3">Vehicle Type</td>
                        <td class="p-3"><a href="/type/{{ $brand->type->type_slug }}">{{ $brand->type->type_name }}</a></td>
                      </tr>
                      <tr>
                        <td class="p-3">Vehicle Name</td>
                        <td class="p-3"><a href="/brand/{{ $brand->brand_slug.'/'.$vehicle->vehicle_slug }}">{{ $vehicle->vehicle_name }}</a></td>
                      </tr>
                      <tr>
                        <td class="p-3">Vehicle Picture</td>
                        <td class="p-3">
                          <img src="{{ asset('/'.$vehicle->vehicle_image) }}" alt="" class="image">
                        </td>
                      </tr>
                      <tr>
                        <td class="p-3">Plate Number</td>
                        <td class="p-3">{{ $vehicle->number_plate }}</td>
                      </tr>
                      <tr>
                        <td class="p-3">Status Rental</td>
                        <td class="p-3">{{ ($transaction->status !== 'Approved') ? 'Approved | '.$transaction->status : $transaction->status }}</td>
                      </tr>
                      @if ($transaction->status == 'Rejected') 
                      <tr>
                        <td class="p-3">Reason Rejected</td>
                        <td class="p-3">{{ $transaction->reason }}</td>
                      </tr>
                      @endif
                      <tr>
                        <td class="p-3">Start Rental</td>
                        <td class="p-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->start_rent_date)) }}</td>
                      </tr>
                      <tr>
                        <td class="p-3">End Rental</td>
                        <td class="p-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->end_rent_date)) }}</td>
                      </tr>
                      @if (!is_null($transaction->vehicle_picked)) 
                      <tr>
                        <td class="p-3">Vehicle Picked</td>
                        <td class="p-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->vehicle_picked)) }}</td>
                      </tr>
                      @endif
                      @if (!is_null($transaction->vehicle_picked)) 
                      <tr>
                        <td class="p-3">Vehicle Returned</td>
                        <td class="p-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->vehicle_returned)) }}</td>
                      </tr>
                      @endif
                      <tr>
                        <td class="p-3">Guarante</td>
                        <td class="p-3">
                          <ul class="list-unstyled">
                            <li><a href="{{ asset('/'.$transaction->guarante_rent_1) }}">Guarante 1</a></li>
                            @if (!is_null($transaction->guarante_rent_2))
                            <li><a href="{{ asset('/'.$transaction->guarante_rent_2) }}">Guarante 2</a></li>
                            @endif
                            @if (!is_null($transaction->guarante_rent_3))
                            <li><a href="{{ asset('/'.$transaction->guarante_rent_3) }}">Guarante 3</a></li>
                            @endif
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <td class="p-3">Rental Price</td>
                        <td class="p-3">Rp.{{ number_format($transaction->rent_price,2,',','.') }}</td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="box-head mb-3">
                    <h3>Payment Details</h3>
                </div>
                
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="p-3">Cashier</td>
                      <td class="p-3">{{ $transaction->payment->cashier }}</td>
                    </tr>
                    <tr>
                      <td class="p-3">Payment Type</td>
                      <td class="p-3">{{ $transaction->payment->payment_type }}</td>
                    </tr>
                    <tr>
                      <td class="p-3">Paid Date</td>
                      <td class="p-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->payment->paid_date)) }}</td>
                    </tr>
                    <tr>
                      <td class="p-3">Payer Name</td>
                      <td class="p-3">{{ $transaction->payment->payer_name }}</td>
                    </tr>
                    <tr>
                      <td class="p-3">Bank</td>
                      <td class="p-3">{{ $transaction->payment->bank }}</td>
                    </tr>
                    <tr>
                      <td class="p-3">Account Number</td>
                      <td class="p-3">{{ $transaction->payment->no_rek }}</td>
                    </tr>
                    <tr>
                      <td class="p-3">Paid Total</td>
                      <td class="p-3">Rp.{{ number_format($transaction->payment->paid_total,2,',','.') }}</td>
                    </tr>
                  </tbody>
                </table>

              </div>
          </div>
      </div>
    </div>
  </section>

  @include('Partials.alert')
@endsection
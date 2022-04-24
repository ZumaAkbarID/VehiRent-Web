@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <!-- Inline text elements -->
    <div class="col">
        <div class="card mb-4">
          <h5 class="card-header">Detail #{{ $transaction->transaction_code }} <small><a href="{{ route('historyMember') }}">Back</a></small></h5>
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="align-middle fw-bold">#</td>
                  <td class="py-3 fw-bold">
                    Description
                  </td>
                </tr>
                
                <tr>
                    <td>Transaction Code</td>
                    <td class="py-3">#{{ $transaction->transaction_code }}</td>
                  </tr>
                  <tr>
                    <td>Vehicle Brand</td>
                    <td class="py-3"><a href="/brand/{{ $brand->brand_slug }}">{{ $brand->brand_name }}</a></td>
                  </tr>
                  <tr>
                    <td>Vehicle Type</td>
                    <td class="py-3"><a href="/type/{{ $brand->type->type_slug }}">{{ $brand->type->type_name }}</a></td>
                  </tr>
                  <tr>
                    <td>Vehicle Name</td>
                    <td class="py-3"><a href="/brand/{{ $brand->brand_slug.'/'.$vehicle->vehicle_slug }}">{{ $vehicle->vehicle_name }}</a></td>
                  </tr>
                  <tr>
                    <td>Vehicle Picture</td>
                    <td class="py-3">
                      <img src="{{ asset('/'.$vehicle->vehicle_image) }}" alt="" class="image">
                    </td>
                  </tr>
                  <tr>
                    <td>Plate Number</td>
                    <td class="py-3">{{ $vehicle->number_plate }}</td>
                  </tr>
                  <tr>
                    <td>Status Rental</td>
                    <td class="py-3">{{ ($transaction->status !== 'Approved') ? 'Approved | '.$transaction->status : $transaction->status }}</td>
                  </tr>
                  @if ($transaction->status == 'Rejected') 
                  <tr>
                    <td>Reason Rejected</td>
                    <td class="py-3">{{ $transaction->reason }}</td>
                  </tr>
                  @endif
                  <tr>
                    <td>Start Rental</td>
                    <td class="py-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->start_rent_date)) }}</td>
                  </tr>
                  <tr>
                    <td>End Rental</td>
                    <td class="py-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->end_rent_date)) }}</td>
                  </tr>
                  @if (!is_null($transaction->vehicle_picked)) 
                  <tr>
                    <td>Vehicle Picked</td>
                    <td class="py-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->vehicle_picked)) }}</td>
                  </tr>
                  @endif
                  @if (!is_null($transaction->vehicle_picked)) 
                  <tr>
                    <td>Vehicle Returned</td>
                    <td class="py-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->vehicle_returned)) }}</td>
                  </tr>
                  @endif
                  <tr>
                    <td>Guarante</td>
                    <td class="py-3">
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
                    <td>Rental Price</td>
                    <td class="py-3">Rp.{{ number_format($transaction->rent_price,2,',','.') }}</td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
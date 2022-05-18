@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <!-- Inline text elements -->
    <div class="col">
        <div class="card mb-4">
          <div class="card-header">
            <h5>Detail #{{ $transaction->transaction_code }} <small><a href="{{ route('historyMember') }}">Back</a></small></h5>
            <a href="{{ route('viewInvoice', $transaction->transaction_code) }}" class="text-right">View Invoice Mode</a>
          </div>
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
                    <td class="py-3">{{ $brand->brand_name }}</td>
                  </tr>
                  <tr>
                    <td>Vehicle Type</td>
                    <td class="py-3">{{ $brand->type->type_name }}</td>
                  </tr>
                  <tr>
                    <td>Vehicle Name</td>
                    <td class="py-3">{{ $vehicle->vehicle_name }}</td>
                  </tr>
                  <tr>
                    <td>Vehicle Picture</td>
                    <td class="py-3">
                      <img src="{{ asset('/storage/'.$vehicle->vehicle_image) }}" alt="{{ $vehicle->vehicle_name }}" class="img-fluid" width="250px">
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
                    <td>Start Book/Rental</td>
                    <td class="py-3">{{ date('D d-M-Y H:i:s', strtotime($transaction->start_rent_date)) }}</td>
                  </tr>
                  <tr>
                    <td>End Book/Rental</td>
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
                        <li><a target="_blank" href="{{ asset('/storage/'.$transaction->guarante_rent_1) }}">Guarante 1</a></li>
                        @if (!is_null($transaction->guarante_rent_2))
                        <li><a target="_blank" href="{{ asset('/storage/'.$transaction->guarante_rent_2) }}">Guarante 2</a></li>
                        @endif
                        @if (!is_null($transaction->guarante_rent_3))
                        <li><a target="_blank" href="{{ asset('/storage/'.$transaction->guarante_rent_3) }}">Guarante 3</a></li>
                        @endif
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>Rental Price</td>
                    <td class="py-3">Rp.{{ number_format($vehicle->rent_price,2,',','.') }}/day</td>
                  </tr>
                  <tr>
                    <td>Total Rental Price</td>
                    <td class="py-3">Rp.{{ number_format($transaction->rent_price,2,',','.') }} 
                    @if(isset($transaction->payment->transaction_code))
                      <p class="btn btn-success">Paid</p>
                      @else
                      <p class="btn btn-success">Unpaid</p> <a href="{{ route('pay', $transaction->transaction_code) }}">Click here to pay</a>
                    @endif
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Manage Transaction</h5>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Vehicle</th>
                  <th>Status</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">

                @if (sizeof($transaction) == 0)
                  <tr>
                    <td colspan="5" class="text-center">No data record</td>
                  </tr>
                @else
                  @foreach ($transaction as $item)
                  <tr>
                    <td><i class="fab fa-angular fa-lg text-danger"></i> <strong><a href="{{ route('AdminCekHistory', $item->transaction_code) }}">#{{ $item->transaction_code }}</a></strong></td>
                    <td>{{ $item->vehicleSpec->vehicle_name }}</td>
                    <td>
                      @if($item->status == 'Approved') 
                      <span class="badge bg-label-success me-1">{{ $item->status }}</span>
                      @elseif($item->status == 'Not Picked')
                      <span class="badge bg-label-primary me-1">Approved | {{ $item->status }}</span>
                      @elseif($item->status == 'Rejected')
                      <span class="badge bg-label-danger me-1">{{ $item->status }}</span>
                      @elseif($item->status == 'Not Restored')
                      <span class="badge bg-label-warning me-1">{{ $item->status }}</span>
                      @else
                      <span class="badge bg-label-success me-1">Approved | {{ $item->status }}</span>
                      @endif
                    </td>
                    <td>Rp.{{ number_format($item->rent_price,2,',','.') }}</td>
                    <td>
                      <a href="{{ route('AdminCekHistory', $item->transaction_code) }}">View Detail</a>
                    </td>
                  </tr>
                  @endforeach
                @endif
                
              </tbody>
            </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
@endsection
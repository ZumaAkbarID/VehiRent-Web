@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Welcome back, {{ auth()->user()->name }}! 🎉</h5>
                <p class="mb-4">
                  <i>{{ $quote['content'] }}</i>
                  ~ {{ $quote['author'] }}
                </p>

              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="/assets/sneat/img/illustrations/man-with-laptop-light.png"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="/assets/sneat/img/icons/unicons/chart-success.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span>All Rental Success</span>
                <h3 class="card-title mb-2">{{ $rentalSuccess }}</h3>
                <small class="text-secondary fw-semibold">All time</small>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="/assets/sneat/img/icons/unicons/wallet-info.png"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                </div>
                <span>All Rental Ongoing</span>
                <h3 class="card-title text-nowrap mb-1">{{ $rentalOngoing }}</h3>
                <small class="text-secondary fw-semibold">All time</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Transactions -->
      <div class="col-md-6 col-lg-8 order-2 mb-4">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Lasted Transactions</h5>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="transactionID"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                <a class="dropdown-item" href="javascript:location.reload();">Refresh</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="p-0 m-0">
              @foreach ($lastTransaction as $item)
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="/assets/sneat/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Trx Code : <a href="{{ route('AdminCekHistory', $item->transaction_code) }}">{{ $item->transaction_code }}</a></small>
                    <h6 class="mb-0">
                      @foreach ($vehicleSpec as $vehicle)
                          @if($item->rental->id_vehicle == $vehicle->id)
                            {{ $vehicle->vehicle_name }}
                          @endif
                      @endforeach
                    </h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+{{ number_format($item->paid_total,2,',','.') }}</h6>
                    <span class="text-muted">IDR</span>
                  </div>
                </div>
              </li>
              @endforeach
              
            </ul>
          </div>
        </div>
      </div>
      <!--/ Transactions -->
    </div>
  </div>
</div>
  
@endsection
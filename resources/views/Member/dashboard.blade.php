@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Welcome back, {{ auth()->user()->name }}! 👋</h5>
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
                <span>Rental Success</span>
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
                <span>Rental Ongoing</span>
                <h3 class="card-title text-nowrap mb-1">{{ $rentalOngoing }}</h3>
                <small class="text-secondary fw-semibold">All time</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@extends('Layouts.Dashboard.dashboard')
@section('dashboard')
    <!-- Responsive Table -->
    @if(auth()->user()->kyc == null)
        <div class="mb-4">
          @include('Partials.kyc')
        </div>
        @endif
    <div class="card">
        <h5 class="card-header">{{ config('app.name') }} Payments</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <ul class="list-unstyled">
                        <li>Cara Bayar</li>
                    </ul>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <form action="{{ route('payProcess') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_rental" value="{{ $rental->id }}">
                        <input type="hidden" name="paid_total" value="{{ $rental->rent_price }}">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="transaction_code">Transaction Code</label>
                                    <input type="text" name="transaction_code" id="transaction_code" readonly value="{{ $rental->transaction_code }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="price">Price Required</label>
                                    <input type="text" name="price" id="price" readonly value="Rp {{ number_format($rental->rent_price,2,',','.') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="payer_name">Payer Name</label>
                                    <input type="text" name="payer_name" id="payer_name" value="" class="form-control" required placeholder="Name who pay">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="payment_proof">Payment Proof</label>
                                    <input type="file" name="payment_proof" id="payment_proof" value="" class="form-control" required placeholder="Payment proof" accept=".jpg,.png,.pdf,.jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
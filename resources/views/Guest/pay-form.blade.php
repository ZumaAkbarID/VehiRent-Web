<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <style>body{background: #f5f5f5}.rounded{border-radius: 1rem}.nav-pills .nav-link{color: #555}.nav-pills .nav-link.active{color: white}input[type="radio"]{margin-right: 5px}.bold{font-weight:bold}</style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
    <div class="container py-5">
        <!-- For demo purpose -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-6">{{ config('app.name') }} Payment Simulation</h1>
            </div>
        </div> <!-- End -->
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#manual" class="nav-link "> <i class="fas fa-money-bill"></i> Manual </a> </li>
                            </ul>
                        </div> <!-- End -->
                        <!-- Credit card form content -->
                        <div class="tab-content">
                            <!-- credit card info-->
                            <div id="credit-card" class="tab-pane fade show active pt-3">
                                <form role="form" action="{{ route('payProcess') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="transaction_code" value="{{ $rental->transaction_code }}">
                                    <input type="hidden" name="id_rental" value="{{ $rental->id }}">
                                    <input type="hidden" name="cashier" value="Credit Card Payment Gateway">
                                    <input type="hidden" name="payment_type" value="CC">
                                    <input type="hidden" name="paid_date" value="{{ date('Y-m-d H:i:s') }}">
                                    <input type="hidden" name="bank" value="CC">
                                    <input type="hidden" name="paid_total" value="{{ $rental->rent_price }}">
                                    <div class="form-group"> <label for="username">
                                            <h6>Card Owner</h6>
                                        </label> <input type="text" name="payer_name" placeholder="Card Owner Name" required class="form-control "> </div>
                                    <div class="form-group"> <label for="cardNumber">
                                            <h6>Card number</h6>
                                        </label>
                                        <div class="input-group"> <input type="text" name="no_ref" placeholder="Valid card number" class="form-control " required>
                                            <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group"> <label><span class="hidden-xs">
                                                        <h6>Expiration Date</h6>
                                                    </span></label>
                                                <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                    <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                </label> <input type="text" required class="form-control"> </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        Total amount : Rp.{{ number_format($rental->rent_price,2,',','.') }}
                                    </div>
                                    <div class="card-footer"> <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Pay Now </button>
                                </form>
                            </div>
                        </div> <!-- End -->
                        <!-- manual info -->
                        <div id="manual" class="tab-pane fade pt-3">
                            <form role="form" action="{{ route('payProcess') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transaction_code" value="{{ $rental->transaction_code }}">
                                <input type="hidden" name="id_rental" value="{{ $rental->id }}">
                                <input type="hidden" name="cashier" value="Manual Cashier">
                                <input type="hidden" name="payment_type" value="Manual">
                                <input type="hidden" name="paid_date" value="{{ date('Y-m-d H:i:s') }}">
                                <input type="hidden" name="bank" value="Manual">
                                <input type="hidden" name="paid_total" value="{{ $rental->rent_price }}">
                                <div class="form-group"> <label for="username">
                                    <h6>Your Name</h6>
                                </label> <input type="text" name="payer_name" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="username">
                                    <h6>Reference Code</h6>
                                </label> <input type="text" name="no_ref" value="{{ rand() }}" readonly required class="form-control "> </div>
                                <div class="form-group"> <label for="username">
                                    <h6>Total Amount</h6>
                                </label> <input type="text" value="Rp.{{ number_format($rental->rent_price,2,',','.') }}" readonly required class="form-control "> </div>
                                <p> <button type="submit" class="btn btn-primary w-100"><i class="fas fa-money-check-alt"></i> Pay Now</button> </p>
                                {{-- <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p> --}}
                            </form>
                        </div> <!-- End -->
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
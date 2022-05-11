@extends('Layouts.Guest.default')
@section('content')
<style>
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
</style>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/storage/'.$vehicle->vehicle_image.'?height=1024') }});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Rental <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Vehicle {{ $vehicle->vehicle_name }}</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Rental
                <small class="page-info">
                    Form
                </small>
            </h1>
    
        </div>
    
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
    
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ auth()->user()->name }}</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    {{ auth()->user()->address }}
                                </div>
                                <div class="my-1"><i class="fa fa-envelope fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ auth()->user()->email }}</b></div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ auth()->user()->phone_number }}</b></div>
                            </div>
                        </div>
                        <!-- /.col -->
    
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Date:</span> {{ date('D d M Y') }}</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">Unpaid</span></div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <form action="{{ route('createInvoice') }}" method="post" enctype="multipart/form-data" accept=".jpg,.png,.jpeg,.pdf">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id_vehicle" value="{{ $vehicle->id }}" required>
                            <div class="col-md-6 mb-4">
                                <label for="start_rent_date">Start Rental Date <span class="text-danger" style="font-size: 12px">required</span></label>
                                <input type="date" name="start_date" id="start_rent_date" class="form-control form-control-sm" required>
                                <input type="hidden" name="start_rent_date" id="startDate" value="" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="end_rent_date">End Rental Date <span class="text-danger" style="font-size: 12px">required</span></label>
                                <input type="date" name="end_rent_date" id="end_rent_date" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="guarante_rent_1">KTP <span class="text-danger" style="font-size: 12px">required</span></label>
                                <input type="file" name="guarante_rent_1" id="guarante_rent_1" required class="form-control" accept=".jpg,.png,.jpeg,.pdf">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="guarante_rent_2">SIM</label>
                                <input type="file" name="guarante_rent_2" id="guarante_rent_2" class="form-control" accept=".jpg,.png,.jpeg,.pdf">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="guarante_rent_3">KK</label>
                                <input type="file" name="guarante_rent_3" id="guarante_rent_3" class="form-control" accept=".jpg,.png,.jpeg,.pdf">
                            </div>
                            <input type="hidden" name="rentalDays" id="rentalDaysForm" value="">
                            <input type="hidden" name="totalAmount" id="totalAmountForm" value="">
                        </div>
    
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="col-6 col-sm-4">Vehicle</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Brand</div>
                            <div class="col-2">Type</div>
                            <div class="d-none d-sm-block col-sm-4">Unit Price</div>
                        </div>
    
                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="col-6 col-sm-4">{{ $vehicle->vehicle_name }}</div>
                                <div class="d-none d-sm-block col-2">{{ $vehicle->brand->brand_name }}</div>
                                <div class="col-2 text-secondary-d2">{{ $vehicle->type->type_name }}</div>
                                <div class="d-none d-sm-block col-4 text-95">Rp.{{ number_format($vehicle->rent_price,2,',','.') }} x<span id="rentDays">0</span> day(s)</div>
                            </div>
    
                        </div>
    
                        <div class="row border-b-2 brc-default-l2"></div>
    
                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            </div>
    
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
    
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Total Amount
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">Rp.<span id="totalAmount">0</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <hr />
    
                        <div>
                            <span class="text-secondary-d1 text-105">Thank you for your business</span>
                            <button type="submit" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0" id="rentalNow">Rental Now</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

  <script>
    var start_rent_date = $('#start_rent_date');
    var end_rent_date = $('#end_rent_date');
    var rentalNowBtn = $('#rentalNow');
    var rent_price = {{ $vehicle->rent_price }};

        $(document).on('ready', function() {
            end_rent_date.attr('disabled', 'disabled');
            rentalNowBtn.attr('disabled', 'disabled');
        });

        start_rent_date.on('change', function() {
            end_rent_date.removeAttr('disabled');
            end_rent_date.attr('min', start_rent_date.val());
        });

        end_rent_date.on('change', function() {
            $('#startDate').val(start_rent_date.val());
            start_rent_date.attr('disabled', 'disabled');
            var days = daysdifference(start_rent_date.val(), end_rent_date.val());
            if (days == 0) {
                days = 1;
            }
            $('#rentDays').empty().html(days);
            $('#rentalDaysForm').val(days);

            var total = rent_price * days;
            $('#totalAmount').empty().html(number_format(total, 2, ',','.'));
            $('#totalAmountForm').val(total);
        })

        $('#guarante_rent_1').on('change', function() {
            rentalNowBtn.removeAttr('disabled');
        });
      
        function daysdifference(firstDate, secondDate){
            var startDay = new Date(firstDate);
            var endDay = new Date(secondDate);
        
            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = millisBetween / (1000 * 3600 * 24);
        
            return Math.round(Math.abs(days));
        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);

            var nstr = number.toString();
            nstr += '';
            x = nstr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

            return x1 + x2;
        }
  </script>
@endsection
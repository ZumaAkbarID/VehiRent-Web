<section class="ftco-counter ftco-section img bg-light" id="section-counter">
    <div class="overlay"></div>
<div class="container">
    <div class="row">
  <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    <div class="block-18">
      <div class="text text-border d-flex align-items-center">
        <strong class="number" data-number="{{ (date('Y')-2020 == 0) ? 1 : 0 }}">0</strong>
        <span>Year <br>Experienced</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    <div class="block-18">
      <div class="text text-border d-flex align-items-center">
        <strong class="number" data-number="{{ $total_brand }}">0</strong>
        <span>Total <br>Brand</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    <div class="block-18">
      <div class="text text-border d-flex align-items-center">
        <strong class="number" data-number="{{ $total_vehicle }}">0</strong>
        <span>Total <br>Vehicle</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
    <div class="block-18">
      <div class="text d-flex align-items-center">
        <strong class="number" data-number="{{ $total_payment }}">0</strong>
        <span>Total <br>Rental</span>
      </div>
    </div>
  </div>
</div>
</div>
</section>
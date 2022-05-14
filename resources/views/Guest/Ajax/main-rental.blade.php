<div class="row">
    @php
    $name = array();
    @endphp
    @foreach ($vehicles as $vehicle)
       @if (!in_array($vehicle->vehicle_slug, $name))
        <div class="col-md-4">
            <div class="car-wrap rounded">
                <img src="{{ asset('/storage/'.$vehicle->vehicle_image) }}" alt="" class="img rounded d-flex align-items-end">
                <div class="text">
                    <h2 class="mb-0"><a href="{{ route('vehicleSingle', $vehicle->vehicle_slug) }}">{{ $vehicle->vehicle_name }}</a></h2>
                    <div class="d-flex mb-3">
                        <span class="cat">{{ $vehicle->brand->brand_name }}</span>
                        <p class="price ml-auto">Rp.{{ number_format($vehicle->rent_price,2,',','.') }} <span>/day</span></p>
                    </div>
                    <p class="d-flex mb-0 d-block"><a href="{{ route('rentalNow', $vehicle->vehicle_slug) }}" class="btn btn-primary py-2 mr-1">Rental now</a> <a href="{{ route('vehicleSingle', $vehicle->vehicle_slug) }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
                </div>
            </div>
        </div>
        @php
        array_push($name,$vehicle->vehicle_slug)
        @endphp
        @endif
        @endforeach
        @if (sizeof($vehicles) == 0)
        <div class="text-center">
            No data found
        </div>
        @endif
</div>

</div>

<div class="row mt-5">
  <div class="mt-2">
      Displaying {{sizeof($name)}} of {{ $vehicles->total() }} vehicle(s).
  </div>
<div class="col text-center">
  <div class="block-27">
    {!! $vehicles->links('Layouts.Guest.Vendor.pagination') !!}
</div>
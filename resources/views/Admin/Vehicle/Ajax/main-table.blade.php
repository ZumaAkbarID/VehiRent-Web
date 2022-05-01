<div class="table-responsive text-nowrap p-3 pt-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Image</th>
          <th>Vehicle Name</th>
          <th>Type</th>
          <th>Plate Number</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @if (sizeof($vehicles) == 0)
            <tr>
                <td colspan="6" class="text-center">No data record on this page</td>
            </tr>
        @else
            @foreach ($vehicles as $item)
            <tr>
                <td>
                    <img src="{{ asset('/storage/'.$item->vehicle_image) }}" alt="{{ $item->vehicle_name }}" class="img-fluid" width="75" height="75">    
                </td>
                <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $item->vehicle_name }}</strong></td>
                <td>{{ $item->type->type_name }}</td>
                <td>{{ $item->number_plate }}</td>
                <td>
                    @if($item->vehicle_status == 'Available') 
                    <span class="badge bg-label-success me-1">{{ $item->vehicle_status }}</span>
                    @elseif($item->vehicle_status == 'Not Available')
                    <span class="badge bg-label-danger me-1">{{ $item->vehicle_status }}</span>
                    @elseif($item->vehicle_status == 'On Repair')
                    <span class="badge bg-label-warning me-1">{{ $item->vehicle_status }}</span>
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="viewDetail({{ $item->id }})">
                            <i class="bx bx-detail me-1"></i> Detail
                        </button>
                        <button class="dropdown-item" onclick="editForm({{ $item->id }})">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </button>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="deleteItem({{ $item->id }})">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                    </div>
                </td>
            </tr>
            @endforeach
        @endif
        
      </tbody>
    </table>
    <div class="mt-2">
        Displaying {{$vehicles->count()}} of {{ $vehicles->total() }} vehicle(s).
    </div>
    <div class="mt-2">
        {!! $vehicles->links('Layouts.Dashboard.Vendor.pagination') !!}
    </div>
</div>
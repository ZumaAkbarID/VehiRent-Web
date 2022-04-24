<div class="table-responsive text-nowrap p-3 pt-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Id</th>
          <th>Image</th>
          <th>Brand Name</th>
          <th>Type Name</th>
          <th>Created At</th>
          <th>Item</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @if (sizeof($brands) == 0)
            <tr>
                <td colspan="5" class="text-center">No data record on this page</td>
            </tr>
        @else
            @foreach ($brands as $item)
            <tr>
                <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $item->id }}</strong></td>
                <td>
                    <img src="{{ asset('/storage/'.$item->brand_image) }}" alt="{{ $item->brand_name }}" class="img-fluid" width="75" height="75">    
                </td>
                <td>{{ $item->brand_name }}</td>
                <td>{{ $item->type->type_name }}</td>
                <td>
                    {{ date('D d-M-Y H:i:s', strtotime($item->created_at)) }}
                </td>
                <td><a href="/admin/vehicle?brand={{ $item->brand_slug }}">{{ number_format($item->vehicleSpec->count(),0,',','.') }} Vehicle</a></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
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
        Displaying {{$brands->count()}} of {{ $brands->total() }} brand(s).
    </div>
    <div class="mt-2">
        {!! $brands->links('Layouts.Dashboard.Vendor.pagination') !!}
    </div>
</div>
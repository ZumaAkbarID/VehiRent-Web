<div class="table-responsive text-nowrap p-3 pt-0" style="height: 400px">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Id</th>
          <th>Transaction Code</th>
          <th>Name</th>
          <th>Vehicle</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @if (is_null($rental))
            <tr>
                <td colspan="6" class="text-center">No data record on this page</td>
            </tr>
        @else
            <tr>
                <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $rental->id }}</strong></td>
                <td><a href="{{ route('AdminCekHistory', $rental->transaction_code) }}">{{ $rental->transaction_code }}</a></td>
                <td>
                    {{ $rental->user->name }}  
                </td>
                <td>{{ $rental->vehicleSpec->vehicle_name }}</td>
                <td>
                    @if (isset($rental->payment->transaction_code))
                        <p class="btn btn-success">Paid</p>
                        @else 
                        <p class="btn btn-warning">Unpaid</p>
                    @endif 
                </td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="editForm({{ $rental->id }})">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </button>
                    </div>
                    </div>
                </td>
            </tr>
        @endif
        
      </tbody>
    </table>
</div>
<div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="POST" id="updateForm">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalDialogTitle">Action Rental {{ $rental->transaction_code }}</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
          <li>Current Rental Status : {{ $rental->status }}</li>
          <li>Current Vehicle Status : {{ $rental->vehicleSpec->vehicle_status }}</li>
        </ul>
        <div class="row">
          <input type="hidden" name="id" id="id" value="{{ $rental->id }}">
          <input type="hidden" name="id_vehicle" id="id_vehicle" value="{{ $rental->id_vehicle }}">
          <input type="hidden" name="transaction_code" id="transaction_code" value="{{ $rental->transaction_code }}">
          
          <div class="col-12">
            <label for="rental_status">Rental Status</label>
            <select name="rental_status" id="rental_status" class="form-control" required> 
              <option @if($rental->status == 'Completed') selected disabled @endif value="Completed">Completed</option>
              <option @if($rental->status == 'Not Picked') selected disabled @endif value="Not Picked">Not Picked</option>
              <option @if($rental->status == 'In Use') selected disabled @endif value="In Use">In Use / Picked</option>
              <option @if($rental->status == 'Rejected') selected disabled @endif value="Rejected">Rejected</option>
              <option @if($rental->status == 'Returned') selected disabled @endif value="Returned">Returned</option> 
            </select>
          </div>

          <div class="col-12" id="reason">
            <label for="reason">Reason</label>
            <input type="text" name="reason" class="form-control" placeholder="Why?">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" id="closeModalDialog" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>

  <script>
    var rental_status = $('#rental_status');
    var reasonForm = $('#reason');

    $(document).ready(function() {
      reasonForm.hide();
    });
    
    rental_status.on('change', function() {
      if (rental_status.val() == 'Rejected' || rental_status.val() == 'Returned') {
        reasonForm.show();
        reasonForm.attr('required', 'required');
      }else{
        reasonForm.hide();
      }
    });
  </script>
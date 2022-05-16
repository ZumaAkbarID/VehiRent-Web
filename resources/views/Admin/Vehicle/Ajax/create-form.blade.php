<div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="POST" enctype="multipart/form-data" id="createForm">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalDialogTitle">Create New Vehicle</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 mb-3">
            <label for="brand_id" class="form-label">Brand & Type</label>
            <select name="brand_id" id="brand_id" class="form-control" required>
              <option value="">-- Select Brand & Type --</option>
              @if (sizeof($brands) == 0)
                <option value="">No brand record found</option>  
              @else
                @foreach ($brands as $brand)
                  @foreach ($types as $type)
                      @if ($brand->type_id == $type->id)
                          <option value="{{ $brand->id }}"><b>{{ $brand->brand_name }}</b> type <b>{{ $type->type_name }}</b></option>
                      @endif
                  @endforeach
                @endforeach
              @endif
            </select>
          </div>
          <div class="col-12 mb-3">
            <label for="vehicle_name" class="form-label">Vehicle Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Vehicle Name"
              name="vehicle_name" 
              id="vehicle_name" 
              required
              autofocus
            />
          </div>
          
          <div class="col-6 mb-3">
            <label for="number_plate" class="form-label">Number Plate</label>
            <input
              type="text"
              class="form-control"
              placeholder="Plate Number"
              name="number_plate" 
              id="number_plate" 
              required
              autofocus
            />
          </div>
          
          <div class="col-6 mb-3">
            <label for="vehicle_year" class="form-label">Vehicle Year</label>
            <input
              type="number"
              class="form-control"
              placeholder="Vehicle Year"
              name="vehicle_year" 
              id="vehicle_year" 
              required
              autofocus
            />
          </div>
          
          <div class="col-6 mb-3">
            <label for="vehicle_color" class="form-label">Vehicle Color</label>
            <input
              type="text"
              class="form-control"
              placeholder="Vehicle Color"
              name="vehicle_color" 
              id="vehicle_color" 
              required
              autofocus
            />
          </div>
          
          <div class="col-6 mb-3">
            <label for="vehicle_seats" class="form-label">Vehicle Seats</label>
            <input
              type="number"
              class="form-control"
              placeholder="Vehicle Seats"
              name="vehicle_seats" 
              id="vehicle_seats" 
              required
              autofocus
            />
          </div>
          
          <div class="col-12 mb-3">
            <label for="rent_price" class="form-label">Rental Price /day</label>
            <input
              type="number"
              class="form-control"
              placeholder="Rental Price /day (Rp.)"
              name="rent_price" 
              id="rent_price" 
              required
              autofocus
            />
          </div>
          
          <div class="col-12 mb-3">
            <label for="vehicle_description" class="form-label">Vehicle Description</label>
            <textarea
              class="form-control"
              name="vehicle_description" 
              id="summernote" 
              required
              placeholder="HTML Support"
              autofocus
            ></textarea>
          </div>

          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img
              src="/assets/sneat/img/avatars/1.png"
              alt="user-avatar"
              class="d-block rounded"
              height="100"
              width="100"
              id="previewImg"
            />
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Select Vehicle Image</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input
                  type="file"
                  id="upload"
                  class="account-file-input"
                  name="upload"
                  hidden
                  accept="image/png, image/jpeg"
                  onchange="previewFile(this)"
                  required
                />
              </label>
              {{-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button> --}}

              <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" id="closeModalDialog" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" id="btn-submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>

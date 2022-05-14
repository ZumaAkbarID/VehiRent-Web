<div class="modal-dialog modal-dialog-center modal-fullscreen">
  <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title" id="modalDialogTitle">Detail Vehicle {{ $vehicle->vehicle_name }}</h3>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
          
          <div class="col-lg-4 col-sm-12">
            <div class="col-12 mb-3">
              <div class="row justify-content-center">
                <img
                  src="{{ asset('/storage/'.$vehicle->vehicle_image) }}"
                  alt="{{ $vehicle->vehicle_name }}"
                  class="img-fluid rounded"
                  height="200"
                  id="previewImg"
                />
              </div>
            </div>
          </div>

          <div class="col-lg-8 col-sm-12">
            <div class="col-12 mb-3">
              <label for="brand_id" class="form-label">Brand & Type</label>
              <input type="text" name="" id="" readonly value="{{ $brand->brand_name }} type {{ $brand->type->type_name }}" class="form-control">
            </div>
            <div class="col-12 mb-3">
              <label for="vehicle_name" class="form-label">Vehicle Name</label>
              <input
                type="text"
                class="form-control"
                placeholder="Vehicle Name"
                name="vehicle_name" 
                id="vehicle_name" 
                value="{{ $vehicle->vehicle_name }}"
                required
                readonly
                autofocus
              />
            </div>
            
            <div class="row">
              <div class="col-6 mb-3">
                <label for="number_plate" class="form-label">Number Plate</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Plate Number"
                  name="number_plate" 
                  id="number_plate" 
                  value="{{ $vehicle->number_plate }}"
                  required
                  readonly
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
                  value="{{ $vehicle->vehicle_year }}"
                  required
                  autofocus
                  readonly
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
                  value="{{ $vehicle->vehicle_color }}" 
                  required
                  autofocus
                  readonly
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
                  value="{{ $vehicle->vehicle_seats }}"
                  required
                  readonly
                  autofocus
                />
              </div>
              
              <div class="col-6 mb-3">
                <label for="rent_price" class="form-label">Rental Price /day</label>
                <input
                  type="text"
                  class="form-control"
                  name="rent_price" 
                  id="rent_price"
                  value="Rp.{{ number_format($vehicle->rent_price,2,',','.') }}" 
                  required
                  readonly
                />
              </div>
    
              <div class="col-6 mb-3">
                <label for="vehicle_status" class="form-label">Vehicle Status</label>
                <input type="text" readonly value="{{ $vehicle->vehicle_status }}" class="form-control">
              </div>
            </div>
            
            <div class="col-12 mb-3">
              <label for="vehicle_description" class="form-label">Vehicle Description</label>
              <textarea
                class="form-control"
                name="vehicle_description" 
                id="vehicle_description" 
                required
                readonly
                autofocus
              >{{ $vehicle->vehicle_description }}</textarea>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" id="closeModalDialog" data-bs-dismiss="modal">
          Close
        </button>
      </div>
  </div>
  </div>
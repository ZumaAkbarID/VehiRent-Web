<div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="POST" enctype="multipart/form-data" id="updateForm">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalDialogTitle">Edit Brand {{ $brand->brand_name }}</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="brand_id" id="brand_id" value="{{ $brand->id }}">
          <div class="col mb-3">
            <label for="type_id" class="form-label">Type Name</label>
            <select name="type_id" id="type_id" class="form-control" required>
              <option value="">-- Select Type --</option>
              @if (sizeof($types) == 0)
                <option value="">No data record found</option>  
              @else
                @foreach ($types as $item)
                  <option value="{{ $item->id }}" @if($item->id == $brand->type_id) selected @endif>{{ $item->type_name }}</option>
                @endforeach
              @endif
            </select>
          </div>
          <div class="col mb-3">
            <label for="brand_name" class="form-label">Brand Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Brand Name"
              name="brand_name" 
              id="brand_name" 
              value="{{ $brand->brand_name }}"
              required
              autofocus
            />
          </div>
          <div class="d-flex align-items-start align-items-sm-center gap-4">
          <input type="hidden" name="brand_slug" id="brand_slug" value="t">
            <input type="hidden" name="oldImage" id="oldImage" value="{{ $brand->brand_image }}">
            <img
              src="{{ asset('/storage/'.$brand->brand_image) }}"
              alt="user-avatar"
              class="d-block rounded"
              height="100"
              width="100"
              id="previewImg"
            />
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Select Image</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input
                  type="file"
                  id="upload"
                  class="account-file-input"
                  name="upload"
                  hidden
                  accept="image/png, image/jpeg"
                  onchange="previewFile(this)"
                />
              </label>

              <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
            </div>
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
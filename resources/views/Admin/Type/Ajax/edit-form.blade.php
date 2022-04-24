<div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="POST">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="modalDialogTitle">Edit Type {{ $type->type_name }}</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" name="type_id" id="type_id" value="{{ $type->id }}">
          <div class="col mb-3">
            <label for="type_name" class="form-label">Type Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Type Name"
              name="type_name" 
              id="type_name" 
              value="{{ $type->type_name }}"
              required
              autofocus
            />
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
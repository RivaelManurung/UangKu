<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('categories') }}" method="POST">
          @csrf
          <div class="mb-6">
            <label class="form-label" for="category-name">Category Name</label>
            <div class="input-group input-group-merge">
              <span id="category-name-icon" class="input-group-text">
                <i class="icon-base bx bx-category"></i>
              </span>
              <input
                type="text"
                class="form-control"
                id="category-name"
                name="name"
                placeholder="Enter category name"
                aria-label="Enter category name"
                aria-describedby="category-name-icon"
                value="{{ old('name') }}"
                required />
            </div>
            @error('name')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="category-description">Description</label>
            <div class="input-group input-group-merge">
              <span id="category-description-icon" class="input-group-text">
                <i class="icon-base bx bx-comment"></i>
              </span>
              <textarea
                id="category-description"
                class="form-control"
                name="description"
                placeholder="Enter category description"
                aria-label="Enter category description"
                aria-describedby="category-description-icon">{{ old('description') }}</textarea>
            </div>
            @error('description')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Category</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
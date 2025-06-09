<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-6">
            <label class="form-label" for="category-name-{{ $category->id }}">Category Name</label>
            <div class="input-group input-group-merge">
              <span id="category-name-icon-{{ $category->id }}" class="input-group-text">
                <i class="icon-base bx bx-category"></i>
              </span>
              <input
                type="text"
                class="form-control"
                id="category-name-{{ $category->id }}"
                name="name"
                placeholder="Enter category name"
                aria-label="Enter category name"
                aria-describedby="category-name-icon-{{ $category->id }}"
                value="{{ old('name', $category->name) }}"
                required />
            </div>
            @error('name')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="category-type-{{ $category->id }}">Type</label>
            <div class="input-group input-group-merge">
              <span id="category-type-icon-{{ $category->id }}" class="input-group-text">
                <i class="icon-base bx bx-dollar"></i>
              </span>
              <select
                class="form-select"
                id="category-type-{{ $category->id }}"
                name="type"
                aria-label="Select category type"
                aria-describedby="category-type-icon-{{ $category->id }}"
                required>
                <option value="" {{ old('type', $category->type) == '' ? 'selected' : '' }}>Select type</option>
                <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>Income</option>
                <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>Expense</option>
              </select>
            </div>
            @error('type')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="category-description-{{ $category->id }}">Description</label>
            <div class="input-group input-group-merge">
              <span id="category-description-icon-{{ $category->id }}" class="input-group-text">
                <i class="icon-base bx bx-comment"></i>
              </span>
              <textarea
                id="category-description-{{ $category->id }}"
                class="form-control"
                name="description"
                placeholder="Enter category description"
                aria-label="Enter category description"
                aria-describedby="category-description-icon-{{ $category->id }}">{{ old('description', $category->description) }}</textarea>
            </div>
            @error('description')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Category</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
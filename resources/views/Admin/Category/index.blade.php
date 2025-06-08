@extends('admin.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Basic with Icons -->
  <div class="row mb-6 gy-6">
    <div class="col-xl">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Create Category</h5>
          <small class="text-body float-end">Add new category</small>
        </div>
        <div class="card-body">
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
            <button type="submit" class="btn btn-primary">Save Category</button>
            <a href="{{ url('categories') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
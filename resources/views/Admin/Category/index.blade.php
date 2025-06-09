@extends('admin.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Hoverable Table rows -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Categories</h5>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        Create Category
      </button>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>
                <i class="icon-base bx bx-category icon-md text-primary me-4"></i>
                <span>{{ $category->name }}</span>
              </td>
              <td>{{ Str::limit($category->description, 50, '...') }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('categories/' . $category->id . '/edit') }}">
                      <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <form action="{{ url('categories/' . $category->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this category?');">
                        <i class="icon-base bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">No categories found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Hoverable Table rows -->

  <!-- Include Create Category Modal -->
  @include('admin.category.create-modal')
</div>
@endsection
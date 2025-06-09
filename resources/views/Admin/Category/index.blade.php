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
            <th>Type</th>
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
              <td>
                <span class="badge bg-label-{{ $category->type === 'income' ? 'success' : 'danger' }}">
                  {{ ucfirst($category->type) }}
                </span>
              </td>
              <td>{{ Str::limit($category->description, 50, '...') }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                      <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                    </button>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
            <!-- Include Edit Modal for this category -->
            @include('admin.category.edit-modal', ['category' => $category])
          @empty
            <tr>
              <td colspan="5" class="text-center">No categories found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <!-- Pagination -->
      <div class="d-flex justify-content-end mt-4">
        {{ $categories->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->

  <!-- Include Create Category Modal -->
  @include('admin.category.create-modal')
</div>
@endsection
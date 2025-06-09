@extends('admin.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Hoverable Table rows -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Incomes</h5>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createIncomeModal">
        Add Income
      </button>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Balance</th>
            <th>Date</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($incomes as $income)
            <tr>
              <td>{{ $income->id }}</td>
              <td>
                <i class="icon-base bx bx-category icon-md text-primary me-4"></i>
                <span>{{ $income->category->name }}</span>
              </td>
              <td>{{ number_format($income->amount, 2) }}</td>
              <td>{{ $income->balance->name }}</td>
              <td>{{ \Carbon\Carbon::parse($income->date)->format('d M Y') }}</td>
              <td>{{ Str::limit($income->description, 30, '...') }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <button
                      class="dropdown-item edit-income"
                      data-bs-toggle="modal"
                      data-bs-target="#editIncomeModal"
                      data-id="{{ $income->id }}"
                      data-category-id="{{ $income->category_id }}"
                      data-amount="{{ $income->amount }}"
                      data-balance-id="{{ $income->balance_id }}"
                      data-date="{{ $income->date }}"
                      data-description="{{ $income->description }}"
                    >
                      <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                    </button>
                    <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this income?');">
                        <i class="icon-base bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">No incomes found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <!-- Pagination -->
      <div class="d-flex justify-content-end mt-4">
        {{ $incomes->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->

  <!-- Include Modals -->
  @include('admin.income.create-modal')
  @include('admin.income.edit-modal')
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.edit-income').forEach(button => {
    button.addEventListener('click', function () {
        const modal = document.querySelector('#editIncomeModal');
        const form = modal.querySelector('form');
        const id = this.getAttribute('data-id');
        const categoryId = this.getAttribute('data-category-id');
        const amount = this.getAttribute('data-amount');
        const balanceId = this.getAttribute('data-balance-id');
        const date = this.getAttribute('data-date');
        const description = this.getAttribute('data-description');

        form.action = `/incomes/${id}`;
        modal.querySelector('#income-category').value = categoryId;
        modal.querySelector('#income-amount').value = amount;
        modal.querySelector('#income-balance').value = balanceId;
        modal.querySelector('#income-date').value = date;
        modal.querySelector('#income-description').value = description || '';
    });
});
</script>
@endsection
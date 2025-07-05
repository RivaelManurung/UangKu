@extends('admin.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Balances</h5>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBalanceModal">
        Add Balance
      </button>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Account Type</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($balances as $balance)
          <tr>
            <td>{{ $balance->id }}</td>
            <td>
              <i class="icon-base bx bx-wallet icon-md text-primary me-4"></i>
              <span>{{ $balance->account_name }}</span>
            </td>
            <td>{{ number_format($balance->amount, 2) }}</td>
            <td>{{ $balance->account_type }}</td>
            <td>{{ Str::limit($balance->description, 25, '...') }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="icon-base bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <button class="dropdown-item edit-balance" data-bs-toggle="modal" data-bs-target="#editBalanceModal"
                    data-id="{{ $balance->id }}"
                    data-name="{{ $balance->account_name }}"
                    data-amount="{{ $balance->amount }}"
                    data-account-type="{{ $balance->account_type }}"
                    data-description="{{ $balance->description }}">
                    <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                  </button>
                  <form action="{{ route('balances.destroy', $balance->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item"
                      onclick="return confirm('Are you sure you want to delete this balance?');">
                      <i class="icon-base bx bx-trash me-1"></i> Delete
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">No balances found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="d-flex justify-content-end mt-4">
        {{ $balances->links() }}
      </div>
    </div>
  </div>

  @include('admin.balance.create-modal')
  @include('admin.balance.edit-modal')
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-balance').forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.querySelector('#editBalanceModal');
            const form = modal.querySelector('form');
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const amount = this.getAttribute('data-amount');
            const accountType = this.getAttribute('data-account-type');
            const description = this.getAttribute('data-description');

            form.action = `{{ route('balances.update', ':id') }}`.replace(':id', id);
            modal.querySelector('#edit-balance-name').value = name || '';
            modal.querySelector('#edit-balance-amount').value = amount || '';
            modal.querySelector('#edit-balance-account-type').value = accountType || '';
            modal.querySelector('#edit-balance-description').value = description || '';
        });
    });
});
</script>
@endsection
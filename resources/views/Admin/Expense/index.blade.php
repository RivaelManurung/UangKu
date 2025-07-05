@extends('admin.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Expenses</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createExpenseModal">
                Add Expense
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
                    @forelse ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>
                            <i class="icon-base bx bx-category icon-md text-primary me-4"></i>
                            <span>{{ $expense->category->name }}</span>
                        </td>
                        <td>{{ $expense->currency }} {{ number_format($expense->amount, 2) }}</td>
                        <td>{{ $expense->balance->account_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                        <td>{{ Str::limit($expense->description, 30, '...') }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item edit-expense" data-bs-toggle="modal" data-bs-target="#editExpenseModal"
                                        data-id="{{ $expense->id }}"
                                        data-route="{{ route('admin.expense.update', $expense->id) }}" {{-- PERBAIKAN: Tambah data-route --}}
                                        data-category-id="{{ $expense->category_id }}"
                                        data-amount="{{ $expense->amount }}"
                                        data-currency="{{ $expense->currency }}"
                                        data-balance-id="{{ $expense->balance_id }}"
                                        data-date="{{ $expense->date }}"
                                        data-reference="{{ $expense->reference }}"
                                        data-description="{{ $expense->description }}">
                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                    </button>
                                    {{-- PERBAIKAN: Rute 'admin.expense.destroy' --}}
                                    <form action="{{ route('admin.expense.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="icon-base bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No expenses found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4 px-3">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Memasukkan file modal --}}
@include('admin.expense.partials.create-modal')
@include('admin.expense.partials.edit-modal')

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Script untuk mengisi modal edit
    document.querySelectorAll('.edit-expense').forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.querySelector('#editExpenseModal');
            const form = modal.querySelector('#editExpenseForm');
            
            // Mengambil data dari atribut 'data-*'
            const route = this.getAttribute('data-route');
            const categoryId = this.getAttribute('data-category-id');
            const amount = this.getAttribute('data-amount');
            const currency = this.getAttribute('data-currency');
            const balanceId = this.getAttribute('data-balance-id');
            const date = this.getAttribute('data-date');
            const reference = this.getAttribute('data-reference');
            const description = this.getAttribute('data-description');

            // Mengisi form dengan data yang ada
            form.action = route; // PERBAIKAN: Menggunakan rute dari data-attribute
            modal.querySelector('#edit-expense-category').value = categoryId || '';
            modal.querySelector('#edit-expense-amount').value = amount || '';
            modal.querySelector('#edit-expense-currency').value = currency || '';
            modal.querySelector('#edit-expense-balance').value = balanceId || '';
            modal.querySelector('#edit-expense-date').value = date || '';
            modal.querySelector('#edit-expense-reference').value = reference || '';
            modal.querySelector('#edit-expense-description').value = description || '';
        });
    });
});
</script>
@endpush
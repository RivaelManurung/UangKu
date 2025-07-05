{{-- PERBAIKAN: Rute diubah menjadi 'admin.expense.store' --}}
<div class="modal fade" id="createExpenseModal" tabindex="-1" aria-labelledby="createExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createExpenseModalLabel">Add Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.expense.store') }}" method="POST">
                    @csrf
                    {{-- (Isi form sama seperti kode asli Anda) --}}
                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label" for="expense-category">Category</label>
                        <select class="form-select" id="expense-category" name="category_id" required>
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Amount --}}
                    <div class="mb-3">
                        <label class="form-label" for="expense-amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="expense-amount" name="amount" placeholder="Enter amount" value="{{ old('amount') }}" required>
                    </div>
                    {{-- (Sisa field lainnya seperti kode asli) --}}
                    <div class="mb-3">
                        <label class="form-label" for="expense-currency">Currency</label>
                        <select class="form-select" id="expense-currency" name="currency" required>
                            <option value="IDR" {{ old('currency', 'IDR') == 'IDR' ? 'selected' : '' }}>IDR</option>
                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="expense-balance">Balance</label>
                        <select class="form-select" id="expense-balance" name="balance_id" required>
                            <option value="">Select balance</option>
                            @foreach ($balances as $balance)
                                <option value="{{ $balance->id }}" {{ old('balance_id') == $balance->id ? 'selected' : '' }}>{{ $balance->account_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="expense-date">Date</label>
                        <input type="date" class="form-control" id="expense-date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="expense-description">Description</label>
                        <textarea id="expense-description" class="form-control" name="description" placeholder="Optional description">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
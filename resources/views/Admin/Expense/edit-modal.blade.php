<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- PERBAIKAN: Form action akan diisi oleh JavaScript. --}}
                <form id="editExpenseForm" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- (Isi form sama seperti kode asli Anda, tanpa value) --}}
                    <div class="mb-3">
                        <label for="edit-expense-category" class="form-label">Category</label>
                        <select id="edit-expense-category" name="category_id" class="form-select" required>
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-expense-amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" id="edit-expense-amount" name="amount" class="form-control" required>
                    </div>
                     {{-- (Sisa field lainnya seperti kode asli) --}}
                     <div class="mb-3">
                        <label for="edit-expense-currency" class="form-label">Currency</label>
                        <select id="edit-expense-currency" name="currency" class="form-select" required>
                            <option value="IDR">IDR</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-expense-balance" class="form-label">Balance</label>
                        <select id="edit-expense-balance" name="balance_id" class="form-select" required>
                             <option value="">Select balance</option>
                            @foreach ($balances as $balance)
                                <option value="{{ $balance->id }}">{{ $balance->account_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-expense-date" class="form-label">Date</label>
                        <input type="date" id="edit-expense-date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-expense-description" class="form-label">Description</label>
                        <textarea id="edit-expense-description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
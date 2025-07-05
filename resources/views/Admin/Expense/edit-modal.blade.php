```blade
<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editExpenseForm" method="POST">
          @csrf
          @method('POST')

          {{-- Category --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-category">Category</label>
            <select class="form-select" id="edit-expense-category" name="category_id" required>
              <option value="" disabled>Select category</option>
              @forelse ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @empty
                <option value="" disabled>No expense categories available</option>
              @endforelse
            </select>
            @error('category_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Amount --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="edit-expense-amount" name="amount" placeholder="Enter amount" required>
            @error('amount')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Currency --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-currency">Currency</label>
            <select class="form-select" id="edit-expense-currency" name="currency" required>
              <option value="USD">USD</option>
              <option value="IDR">IDR</option>
              <option value="EUR">EUR</option>
              <option value="GBP">GBP</option>
              <option value="JPY">JPY</option>
            </select>
            @error('currency')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Balance --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-balance">Balance</label>
            <select class="form-select" id="edit-expense-balance" name="balance_id" required>
              <option value="" disabled>Select balance</option>
              @forelse ($balances as $balance)
                <option value="{{ $balance->id }}">{{ $balance->account_name }}</option>
              @empty
                <option value="" disabled>No balances available</option>
              @endforelse
            </select>
            @error('balance_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Date --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-date">Date</label>
            <input type="date" class="form-control" id="edit-expense-date" name="date" required>
            @error('date')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Reference --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-reference">Reference</label>
            <input type="text" class="form-control" id="edit-expense-reference" name="reference" placeholder="Optional reference code or note">
            @error('reference')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label" for="edit-expense-description">Description</label>
            <textarea id="edit-expense-description" class="form-control" name="description" placeholder="Optional description"></textarea>
            @error('description')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Buttons --}}
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Expense</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
```
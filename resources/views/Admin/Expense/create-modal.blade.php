<div class="modal fade" id="createExpenseModal" tabindex="-1" aria-labelledby="createExpenseModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createExpenseModalLabel">Add Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('expenses.store') }}" method="POST">
          @csrf

          {{-- Category --}}
          <div class="mb-3">
            <label class="form-label" for="income-category">Category</label>
            <select class="form-select" id="income-category" name="category_id" required>
              <option value="">Select category</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>{{
                $category->name }}</option>
              @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Amount --}}
          <div class="mb-3">
            <label class="form-label" for="expense-amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="expense-amount" name="amount"
              placeholder="Enter amount" value="{{ old('amount') }}" required>
            @error('amount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Currency --}}
          <div class="mb-3">
            <label class="form-label" for="expense-currency">Currency</label>
            <select class="form-select" id="expense-currency" name="currency" required>
              <option value="USD" {{ old('currency', 'USD' )=='USD' ? 'selected' : '' }}>USD</option>
              <option value="IDR" {{ old('currency')=='IDR' ? 'selected' : '' }}>IDR</option>
              <option value="EUR" {{ old('currency')=='EUR' ? 'selected' : '' }}>EUR</option>
              <option value="GBP" {{ old('currency')=='GBP' ? 'selected' : '' }}>GBP</option>
              <option value="JPY" {{ old('currency')=='JPY' ? 'selected' : '' }}>JPY</option>
            </select>
            @error('currency')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Balance --}}
          <div class="mb-3">
            <label class="form-label" for="expense-balance">Balance</label>
            <select class="form-select" id="expense-balance" name="balance_id" required>
              <option value="" disabled selected>Select balance</option>
              @forelse ($balances as $balance)
              <option value="{{ $balance->id }}" {{ old('balance_id')==$balance->id ? 'selected' : '' }}>
                {{ $balance->account_name }}
              </option>
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
            <label class="form-label" for="expense-date">Date</label>
            <input type="date" class="form-control" id="expense-date" name="date"
              value="{{ old('date', date('Y-m-d')) }}" required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label" for="expense-description">Description</label>
            <textarea id="expense-description" class="form-control" name="description"
              placeholder="Optional description">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Buttons --}}
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Expense</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

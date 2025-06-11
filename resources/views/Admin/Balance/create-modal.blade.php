<div class="modal fade" id="createBalanceModal" tabindex="-1" aria-labelledby="createBalanceModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createBalanceModalLabel">Add Balance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('balances.store') }}" method="POST">
          @csrf
          <!-- Account Name -->
          <div class="mb-6">
            <label class="form-label" for="balance-name">Balance Name</label>
            <input type="text" class="form-control" id="balance-name" name="account_name"
              placeholder="Enter balance name" value="{{ old('account_name') }}" required />
            @error('account_name')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Amount -->
          <div class="mb-6">
            <label class="form-label" for="balance-amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="balance-amount" name="amount"
              placeholder="Enter amount" value="{{ old('amount') }}" required />
            @error('amount')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Account Type -->
          <div class="mb-6">
            <label class="form-label" for="account-type">Account Type</label>
            <select id="account-type" name="account_type" class="form-control" required>
              <option value="Cash">Cash</option>
              <option value="Bank">Bank</option>
              <option value="Credit_card">Credit Card</option>
              <option value="Investment">Investment</option>
              <option value="Other">Other</option>
            </select>
            @error('account_type')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Currency -->
          <input type="hidden" name="currency" value="IDR">

          <!-- Description -->
          <div class="mb-6">
            <label class="form-label" for="balance-description">Description</label>
            <textarea id="balance-description" class="form-control" name="description"
              placeholder="Enter description">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Balance</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
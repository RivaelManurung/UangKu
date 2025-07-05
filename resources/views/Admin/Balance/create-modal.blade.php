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
          <div class="mb-3">
            <label class="form-label" for="balance-name">Balance Name</label>
            <input type="text" class="form-control" id="balance-name" name="account_name"
              placeholder="Enter balance name" value="{{ old('account_name') }}" required />
            @error('account_name')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Amount -->
          <div class="mb-3">
            <label class="form-label" for="balance-amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="balance-amount" name="amount"
              placeholder="Enter amount" value="{{ old('amount') }}" required />
            @error('amount')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Account Type -->
          <div class="mb-3">
            <label class="form-label" for="account-type">Account Type</label>
            <select id="account-type" name="account_type" class="form-select" required>
              <option value="" disabled selected>Select account type</option>
              <option value="Cash" {{ old('account_type')=='Cash' ? 'selected' : '' }}>Cash</option>
              <option value="Bank_Account" {{ old('account_type')=='Bank_Account' ? 'selected' : '' }}>Bank Account
              </option>
              <option value="E-Wallet" {{ old('account_type')=='E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
              <option value="Credit_Card" {{ old('account_type')=='Credit_Card' ? 'selected' : '' }}>Credit Card
              </option>
              <option value="E-Money" {{ old('account_type')=='E-Money' ? 'selected' : '' }}>E-Money</option>
              <option value="Investment" {{ old('account_type')=='Investment' ? 'selected' : '' }}>Investment</option>
            </select>
            @error('account_type')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Description -->
          <div class="mb-3">
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
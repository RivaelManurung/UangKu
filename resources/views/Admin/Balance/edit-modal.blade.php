<div class="modal fade" id="editBalanceModal" tabindex="-1" aria-labelledby="editBalanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBalanceModalLabel">Edit Balance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          @csrf
          @method('PUT')

          <!-- Balance Name -->
          <div class="mb-3">
            <label for="edit-balance-name" class="form-label">Balance Name</label>
            <input type="text" class="form-control" id="edit-balance-name" name="account_name" placeholder="Enter balance name" required>
            @error('account_name')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Amount -->
          <div class="mb-3">
            <label for="edit-balance-amount" class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" id="edit-balance-amount" name="amount" placeholder="Enter amount" required>
            @error('amount')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Account Type -->
          <div class="mb-3">
            <label for="edit-balance-account-type" class="form-label">Account Type</label>
            <select id="edit-balance-account-type" name="account_type" class="form-select" required>
              <option value="" disabled>Select account type</option>
              <option value="Cash">Cash</option>
              <option value="Bank Account">Bank Account</option>
              <option value="E-Wallet">E-Wallet</option>
              <option value="Credit Card">Credit Card</option>
              <option value="E-Money">E-Money</option>
              <option value="Investment">Investment</option>
            </select>
            @error('account_type')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="edit-balance-description" class="form-label">Description</label>
            <textarea class="form-control" id="edit-balance-description" name="description" placeholder="Enter description" rows="3"></textarea>
            @error('description')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          <!-- Buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Balance</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
            <label for="balance-name" class="form-label">Balance Name</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-wallet"></i></span>
              <input type="text" class="form-control" id="balance-name" name="name" placeholder="Enter balance name" required>
            </div>
            @error('name')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <!-- Amount -->
          <div class="mb-3">
            <label for="balance-amount" class="form-label">Amount</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-dollar"></i></span>
              <input type="number" step="0.01" class="form-control" id="balance-amount" name="amount" placeholder="Enter amount" required>
            </div>
            @error('amount')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <!-- Type Amount -->
          <div class="mb-3">
            <label for="balance-type-amount" class="form-label">Type Amount</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-transfer"></i></span>
              <select class="form-select" id="balance-type-amount" name="type_amount" required>
                <option value="" disabled selected>-- Select Type --</option>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
              </select>
            </div>
            @error('type_amount')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="balance-description" class="form-label">Description</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-comment"></i></span>
              <textarea class="form-control" id="balance-description" name="description" placeholder="Enter description" rows="3"></textarea>
            </div>
            @error('description')
              <div class="text-danger small">{{ $message }}</div>
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

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
          <div class="mb-6">
            <label class="form-label" for="balance-name">Balance Name</label>
            <div class="input-group input-group-merge">
              <span id="balance-name-icon" class="input-group-text">
                <i class="icon-base bx bx-wallet"></i>
              </span>
              <input
                type="text"
                class="form-control"
                id="balance-name"
                name="name"
                placeholder="Enter balance name"
                aria-label="Enter balance name"
                aria-describedby="balance-name-icon"
                required />
            </div>
            @error('name')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="balance-amount">Amount</label>
            <div class="input-group input-group-merge">
              <span id="balance-amount-icon" class="input-group-text">
                <i class="icon-base bx bx-dollar"></i>
              </span>
              <input
                type="number"
                step="0.01"
                class="form-control"
                id="balance-amount"
                name="amount"
                placeholder="Enter amount"
                aria-label="Enter amount"
                aria-describedby="balance-amount-icon"
                required />
            </div>
            @error('amount')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="balance-description">Description</label>
            <div class="input-group input-group-merge">
              <span id="balance-description-icon" class="input-group-text">
                <i class="icon-base bx bx-comment"></i>
              </span>
              <textarea
                id="balance-description"
                class="form-control"
                name="description"
                placeholder="Enter description"
                aria-label="Enter description"
                aria-describedby="balance-description-icon"></textarea>
            </div>
            @error('description')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Balance</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
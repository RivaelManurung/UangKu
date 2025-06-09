<div class="modal fade" id="createBalanceModal" tabindex="-1" aria-labelledby="createBalanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createBalanceModalLabel">Add Balance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('balances.store') }}" method="POST">
          @csrf
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
                value="{{ old('name') }}"
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
                value="{{ old('amount') }}"
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
                aria-describedby="balance-description-icon">{{ old('description') }}</textarea>
            </div>
            @error('description')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Balance</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
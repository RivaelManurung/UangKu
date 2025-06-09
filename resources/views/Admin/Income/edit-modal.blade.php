<div class="modal fade" id="editIncomeModal" tabindex="-1" aria-labelledby="editIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editIncomeModalLabel">Edit Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-6">
            <label class="form-label" for="income-category">Category</label>
            <div class="input-group input-group-merge">
              <span id="income-category-icon" class="input-group-text">
                <i class="icon-base bx bx-category"></i>
              </span>
              <select
                class="form-select"
                id="income-category"
                name="category_id"
                aria-label="Select category"
                aria-describedby="income-category-icon"
                required>
                <option value="">Select category</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            @error('category_id')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="income-amount">Amount</label>
            <div class="input-group input-group-merge">
              <span id="income-amount-icon" class="input-group-text">
                <i class="icon-base bx bx-dollar"></i>
              </span>
              <input
                type="number"
                step="0.01"
                class="form-control"
                id="income-amount"
                name="amount"
                placeholder="Enter amount"
                aria-label="Enter amount"
                aria-describedby="income-amount-icon"
                required />
            </div>
            @error('amount')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="income-balance">Balance</label>
            <div class="input-group input-group-merge">
              <span id="income-balance-icon" class="input-group-text">
                <i class="icon-base bx bx-wallet"></i>
              </span>
              <select
                class="form-select"
                id="income-balance"
                name="balance_id"
                aria-label="Select balance"
                aria-describedby="income-balance-icon"
                required>
                <option value="">Select balance</option>
                @foreach ($balances as $balance)
                  <option value="{{ $balance->id }}">{{ $balance->name }}</option>
                @endforeach
              </select>
            </div>
            @error('balance_id')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="income-date">Date</label>
            <div class="input-group input-group-merge">
              <span id="income-date-icon" class="input-group-text">
                <i class="icon-base bx bx-calendar"></i>
              </span>
              <input
                type="date"
                class="form-control"
                id="income-date"
                name="date"
                aria-label="Select date"
                aria-describedby="income-date-icon"
                required />
            </div>
            @error('date')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-6">
            <label class="form-label" for="income-description">Description</label>
            <div class="input-group input-group-merge">
              <span id="income-description-icon" class="input-group-text">
                <i class="icon-base bx bx-comment"></i>
              </span>
              <textarea
                id="income-description"
                class="form-control"
                name="description"
                placeholder="Enter description"
                aria-label="Enter description"
                aria-describedby="income-description-icon"></textarea>
            </div>
            @error('description')
              <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Income</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
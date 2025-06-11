<div class="modal fade" id="editIncomeModal" tabindex="-1" aria-labelledby="editIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editIncomeModalLabel">Edit Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="editIncomeForm" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="edit-income-category" class="form-label">Category</label>
            <select id="edit-income-category" name="category_id" class="form-select" required>
              <option value="">Select category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit-income-amount" class="form-label">Amount</label>
            <input type="number" step="0.01" id="edit-income-amount" name="amount" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="edit-income-currency" class="form-label">Currency</label>
            <select id="edit-income-currency" name="currency" class="form-select" required>
              <option value="USD">USD</option>
              <option value="IDR">IDR</option>
              <option value="EUR">EUR</option>
              <option value="GBP">GBP</option>
              <option value="JPY">JPY</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="edit-income-balance" class="form-label">Balance</label>
            <select id="edit-income-balance" name="balance_id" class="form-select" required>
              <option value="">Select balance</option>
              @foreach ($balances as $balance)
                <option value="{{ $balance->id }}">{{ $balance->account_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit-income-date" class="form-label">Date</label>
            <input type="date" id="edit-income-date" name="date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="edit-income-source-type" class="form-label">Source Type</label>
            <select id="edit-income-source-type" name="source_type" class="form-select">
              <option value="">Select source type</option>
              <option value="salary">Salary</option>
              <option value="investment">Investment</option>
              <option value="freelance">Freelance</option>
              <option value="gift">Gift</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="edit-income-reference" class="form-label">Reference</label>
            <input type="text" id="edit-income-reference" name="reference" class="form-control">
          </div>

          <div class="mb-3">
            <label for="edit-income-description" class="form-label">Description</label>
            <textarea id="edit-income-description" name="description" class="form-control"></textarea>
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

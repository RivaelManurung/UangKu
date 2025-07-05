<div class="modal fade" id="createIncomeModal" tabindex="-1" aria-labelledby="createIncomeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createIncomeModalLabel">Add Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('incomes.store') }}" method="POST">
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
            <label class="form-label" for="income-amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="income-amount" name="amount"
              placeholder="Enter amount" value="{{ old('amount') }}" required>
            @error('amount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Balance --}}
          <div class="mb-3">
            <label class="form-label" for="income-balance">Balance</label>
            <select class="form-select" id="income-balance" name="balance_id" required>
              <option value="">Select balance</option>
              @foreach ($balances as $balance)
              <option value="{{ $balance->id }}" {{ old('balances_id')==$balance->id ? 'selected' : '' }}>{{
                $balance->account_name }}</option>
              @endforeach
            </select>
            @error('balance_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Date --}}
          <div class="mb-3">
            <label class="form-label" for="income-date">Date</label>
            <input type="date" class="form-control" id="income-date" name="date" value="{{ old('date') }}" required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Source Type --}}
          <div class="mb-3">
            <label class="form-label" for="income-source-type">Sumber Pendapatan</label>
            <select class="form-select" id="income-source-type" name="source_type">
              <option value="" {{ old('source_type')=='' ? 'selected' : '' }}>Pilih sumber</option>
              <option value="Gaji" {{ old('source_type')=='Gaji' ? 'selected' : '' }}>Gaji</option>
              <option value="Investasi" {{ old('source_type')=='Investasi' ? 'selected' : '' }}>Investasi</option>
              <option value="Freelance" {{ old('source_type')=='Freelance' ? 'selected' : '' }}>Freelance</option>
              <option value="Hadiah" {{ old('source_type')=='Hadiah' ? 'selected' : '' }}>Hadiah</option>
              <option value="Bisnis" {{ old('source_type')=='Bisnis' ? 'selected' : '' }}>Bisnis</option>
              <option value="Bunga Bank" {{ old('source_type')=='Bunga Bank' ? 'selected' : '' }}>Bunga Bank</option>
              <option value="Tabungan" {{ old('source_type')=='Tabungan' ? 'selected' : '' }}>Tabungan</option>
            </select>
            @error('source_type')
            <div class="text-danger form-text">{{ $message }}</div>
            @enderror
          </div>

          {{-- Reference --}}
          <div class="mb-3">
            <label class="form-label" for="income-reference">Reference</label>
            <input type="text" class="form-control" id="income-reference" name="reference"
              value="{{ old('reference') }}" placeholder="Optional reference code or note">
            @error('reference')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label class="form-label" for="income-description">Description</label>
            <textarea id="income-description" class="form-control" name="description"
              placeholder="Optional description">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Buttons --}}
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Income</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
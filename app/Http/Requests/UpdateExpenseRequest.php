<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'balance_id' => ['required', 'exists:balances,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'payment_method' => ['nullable', Rule::in(['cash', 'credit_card', 'debit_card', 'bank_transfer', 'other'])],
            'reference' => ['nullable', 'string', 'max:255'],
            'is_recurring' => ['boolean'],
            'recurring_interval' => ['nullable', 'string', 'max:255', 'required_if:is_recurring,1'],
            'recurring_end_date' => ['nullable', 'date', 'after_or_equal:date'],
        ];
    }
}
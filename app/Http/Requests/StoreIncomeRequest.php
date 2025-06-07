<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreIncomeRequest extends FormRequest
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
            'source_type' => ['nullable', Rule::in(['salary', 'investment', 'freelance', 'gift', 'other'])],
            'reference' => ['nullable', 'string', 'max:255'],
        ];
    }
}
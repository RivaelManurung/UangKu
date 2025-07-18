<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateIncomeRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'source_type' => ['nullable', Rule::in(['Gaji', 'Investasi', 'Freelance', 'Hadiah', 'Bisnis', 'Bunga Bank', 'Tabungan'])],
            'reference' => ['nullable', 'string', 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBalanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'account_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'account_type' => ['required', Rule::in(['cash', 'bank', 'credit_card', 'investment', 'other'])],
            'currency' => ['required', 'string', 'size:3'],
            'description' => ['nullable', 'string'],
        ];
    }
}
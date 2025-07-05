<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreBalanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'account_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'account_type' => [      // ✅ Perbaiki aturan ini
                'required',
                Rule::in([
                    'Cash',
                    'Bank_Account',
                    'E-Wallet',
                    'Credit_Card',
                    'E-Money',
                    'Investment'
                ]),
            ],
        ];
    }
}

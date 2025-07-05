<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
// Auth facade tidak lagi dibutuhkan jika menggunakan $this->user()
// use Illuminate\Support\Facades\Auth;

class UpdateBalanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // ✅ PERBAIKAN: Memeriksa apakah balance yang akan diupdate
        // adalah milik user yang sedang login. Ini lebih aman.
        $balance = $this->route('balance');
        return $balance && $this->user()->can('update', $balance);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'account_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'account_type' => ['required', Rule::in([
                'Cash',
                'Bank_Account',
                'E-Wallet',
                'Credit_Card',
                'E-Money',
                'Investment'
            ])],
        ];
    }
}
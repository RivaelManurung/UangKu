<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Balance;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class ExpenseController extends BaseController
{
    public function __construct()
    {
        // Asumsi 'auth.custom' adalah middleware otentikasi Anda
        $this->middleware('auth.custom');
    }

    /**
     * Menampilkan daftar pengeluaran beserta modal untuk menambah & mengedit.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $expenses = $user->expenses()->with(['category', 'balance'])->latest()->paginate(8);
        $categories = $user->categories()->where('type', 'income')->get();
        $balances = $user->balances()->get();
        return view('admin.expense.index', compact('expenses', 'categories', 'balances'));
    }


    /**
     * Menyimpan pengeluaran baru.
     */
    public function store(StoreExpenseRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $balance = Balance::findOrFail($data['balance_id']);

            // Perbaikan: Otorisasi dengan memeriksa kepemilikan langsung.
            // Ini lebih jelas daripada menggunakan policy 'update' pada balance.
            if ($balance->user_id !== $user->id) {
                abort(403, 'Unauthorized action.');
            }

            $user->expenses()->create($data);
            $balance->decrement('amount', $data['amount']);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
    }

    /**
     * Mengupdate data pengeluaran.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        // Otorisasi untuk memastikan pengguna hanya bisa mengedit pengeluarannya sendiri.
        $this->authorize('update', $expense);

        DB::transaction(function () use ($request, $expense) {
            $data = $request->validated();

            $oldAmount = $expense->amount;
            $oldBalance = $expense->balance; // Mengambil relasi yang sudah di-load

            // Kembalikan dulu saldo lama
            $oldBalance->increment('amount', $oldAmount);

            // Update pengeluaran dengan data baru
            $expense->update($data);

            // Kurangi saldo baru (bisa jadi akun yang sama atau berbeda)
            $newBalance = Balance::findOrFail($data['balance_id']);
            $newBalance->decrement('amount', $data['amount']);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    /**
     * Menghapus data pengeluaran.
     */
    public function destroy(Expense $expense)
    {
        // Otorisasi untuk memastikan pengguna hanya bisa menghapus pengeluarannya sendiri.
        $this->authorize('delete', $expense);

        DB::transaction(function () use ($expense) {
            $balance = $expense->balance;
            // Kembalikan jumlah saldo sebelum menghapus data pengeluaran
            $balance->increment('amount', $expense->amount);
            $expense->delete();
        });

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}

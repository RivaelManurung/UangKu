<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class ExpenseController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $expenses = $user->expenses()->with(['category', 'balance'])->paginate(8);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = $user->categories()->where('type', 'expense')->get();
        $balances = $user->balances()->get();
        return view('expenses.create', compact('categories', 'balances'));
    }

    public function store(StoreExpenseRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $balance = Balance::findOrFail($data['balance_id']);
            $this->authorize('update', $balance);

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $expense = $user->expenses()->create($data);
            $balance->decrement('amount', $data['amount']);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = $user->categories()->where('type', 'expense')->get();
        $balances = $user->balances()->get();
        return view('expenses.edit', compact('expense', 'categories', 'balances'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        DB::transaction(function () use ($request, $expense) {
            $data = $request->validated();
            $this->authorize('update', $expense);

            $oldAmount = $expense->amount;
            $oldBalance = Balance::findOrFail($expense->balance_id);
            $newBalance = Balance::findOrFail($data['balance_id']);

            $expense->update($data);

            $oldBalance->increment('amount', $oldAmount);
            $newBalance->decrement('amount', $data['amount']);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        DB::transaction(function () use ($expense) {
            $this->authorize('delete', $expense);
            $balance = Balance::findOrFail($expense->balance_id);
            $balance->increment('amount', $expense->amount);
            $expense->delete();
        });

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class IncomeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $incomes = $user->incomes()->with(['category', 'balance'])->paginate(8);
        $categories = $user->categories()->where('type', 'income')->get();
        $balances = $user->balances()->get();
        return view('admin.income.index', compact('incomes', 'categories', 'balances'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = $user->categories()->where('type', 'income')->get();
        $balances = $user->balances()->get();
        return view('admin.income.create', compact('categories', 'balances'));
    }

    public function store(StoreIncomeRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $balance = Balance::findOrFail($data['balance_id']);
            $this->authorize('update', $balance);

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $income = $user->incomes()->create($data);
            $balance->increment('amount', $data['amount']);
        });

        return redirect()->route('admin.income.index')->with('success', 'Income recorded successfully.');
    }

    public function show(Income $income)
    {
        $this->authorize('view', $income);
        return view('admin.income.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = $user->categories()->where('type', 'income')->get();
        $balances = $user->balances()->get();
        return view('admin.income.edit', compact('income', 'categories', 'balances'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        DB::transaction(function () use ($request, $income) {
            $data = $request->validated();
            $this->authorize('update', $income);

            $oldAmount = $income->amount;
            $oldBalance = Balance::findOrFail($income->balance_id);
            $newBalance = Balance::findOrFail($data['balance_id']);

            $income->update($data);

            $oldBalance->decrement('amount', $oldAmount);
            $newBalance->increment('amount', $data['amount']);
        });

        return redirect()->route('admin.income.index')->with('success', 'Income updated successfully.');
    }

    public function destroy(Income $income)
    {
        DB::transaction(function () use ($income) {
            $this->authorize('delete', $income);
            $balance = Balance::findOrFail($income->balance_id);
            $balance->decrement('amount', $income->amount);
            $income->delete();
        });

        return redirect()->route('admin.income.index')->with('success', 'Income deleted successfully.');
    }
}
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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IncomeController extends BaseController
{
    use AuthorizesRequests;

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
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $data = $request->validated();
            $balance = Balance::findOrFail($data['balance_id']);
            $this->authorize('update', $balance);

            $user->incomes()->create($data);
            $balance->increment('amount', $data['amount']);
        });

        return redirect()->route('incomes.index')->with('success', 'Income recorded successfully.');
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
        $this->authorize('update', $income);
        DB::transaction(function () use ($request, $income) {
            $data = $request->validated();
            $oldAmount = $income->amount;
            $oldBalance = Balance::findOrFail($income->balance_id);
            $newBalance = Balance::findOrFail($data['balance_id']);
            $this->authorize('update', $newBalance);

            $income->update($data);
            $oldBalance->decrement('amount', $oldAmount);
            $newBalance->increment('amount', $data['amount']);
        });

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully.');
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);
        DB::transaction(function () use ($income) {
            $balance = Balance::findOrFail($income->balance_id);
            $this->authorize('update', $balance);
            $balance->decrement('amount', $income->amount);
            $income->delete();
        });

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully.');
    }
}
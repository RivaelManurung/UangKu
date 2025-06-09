<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Http\Requests\UpdateBalanceRequest;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class BalanceController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $balances = $user->balances()->paginate(10);
        return view('admin.balance.index', compact('balances'));
    }

    public function create()
    {
        return view('admin.balance.create');
    }


    public function store(StoreBalanceRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $balance = $user->balances()->create($request->validated());

        // Buat log info
        Log::info('Balance created', [
            'user_id' => $user->id,
            'balance_id' => $balance->id,
            'account_name' => $balance->account_name,
            'amount' => $balance->amount,
            'account_type' => $balance->account_type,
        ]);

        return redirect()->route('admin.balance.index')->with('success', 'Balance created successfully.');
    }
    public function show(Balance $balance)
    {
        $this->authorize('view', $balance);
        return view('admin.balance.show', compact('balance'));
    }

    public function edit(Balance $balance)
    {
        $this->authorize('update', $balance);
        return view('admin.balance.edit', compact('balance'));
    }

    public function update(UpdateBalanceRequest $request, Balance $balance)
    {
        $this->authorize('update', $balance);
        $balance->update($request->validated());
        return redirect()->route('admin.balance.index')->with('success', 'Balance updated successfully.');
    }

    public function destroy(Balance $balance)
    {
        $this->authorize('delete', $balance);
        $balance->delete();
        return redirect()->route('admin.balance.index')->with('success', 'Balance deleted successfully.');
    }
}

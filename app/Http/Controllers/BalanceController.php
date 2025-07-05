<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Http\Requests\UpdateBalanceRequest;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BalanceController extends BaseController
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

        Log::info('Balance created', [
            'user_id' => $user->id,
            'balance_id' => $balance->id,
        ]);

        // ✅ PERBAIKI RUTE: Ubah 'admin.balance.index' menjadi 'balances.index'
        return redirect()->route('balances.index')->with('success', 'Balance created successfully.');
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

        Log::info('Balance updated', [
            'user_id' => Auth::id(),
            'balance_id' => $balance->id,
        ]);

        // ✅ PERBAIKI RUTE: Ubah 'admin.balance.index' menjadi 'balances.index'
        return redirect()->route('balances.index')->with('success', 'Balance updated successfully.');
    }

    public function destroy(Balance $balance)
    {
        $this->authorize('delete', $balance);

        Log::warning('Balance deleted', [
            'user_id' => Auth::id(),
            'balance_id' => $balance->id,
        ]);

        $balance->delete();

        // ✅ PERBAIKI RUTE: Ubah 'admin.balance.index' menjadi 'balances.index'
        return redirect()->route('balances.index')->with('success', 'Balance deleted successfully.');
    }
}

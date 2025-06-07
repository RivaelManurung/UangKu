<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Http\Requests\UpdateBalanceRequest;
use App\Models\Balance;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;

class BalanceController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $balances = auth()->user()->balances()->paginate(10);
        return view('balances.index', compact('balances'));
    }

    public function create()
    {
        return view('balances.create');
    }

    public function store(StoreBalanceRequest $request)
    {
        auth()->user()->balances()->create($request->validated());
        return redirect()->route('balances.index')->with('success', 'Balance created successfully.');
    }

    public function show(Balance $balance)
    {
        $this->authorize('view', $balance);
        return view('balances.show', compact('balance'));
    }

    public function edit(Balance $balance)
    {
        $this->authorize('update', $balance);
        return view('balances.edit', compact('balance'));
    }

    public function update(UpdateBalanceRequest $request, Balance $balance)
    {
        $this->authorize('update', $balance);
        $balance->update($request->validated());
        return redirect()->route('balances.index')->with('success', 'Balance updated successfully.');
    }

    public function destroy(Balance $balance)
    {
        $this->authorize('delete', $balance);
        $balance->delete();
        return redirect()->route('balances.index')->with('success', 'Balance deleted successfully.');
    }
}
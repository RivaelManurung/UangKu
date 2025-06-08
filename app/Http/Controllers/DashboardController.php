<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Income;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.custom'); // Use auth.custom
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $totalBalance = $user->balances()->sum('amount');
        $totalIncome = $user->incomes()->whereMonth('date', Carbon::now()->month)->sum('amount');
        $totalExpense = $user->expenses()->whereMonth('date', Carbon::now()->month)->sum('amount');
        $recentIncomes = $user->incomes()->with(['category', 'balance'])->latest()->take(5)->get();
        $recentExpenses = $user->expenses()->with(['category', 'balance'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBalance', 'totalIncome', 'totalExpense', 'recentIncomes', 'recentExpenses'));
    }
}
<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Income;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB; // ✅ Tambahkan ini

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Data yang sudah ada
        $totalBalance = $user->balances()->sum('amount');
        $totalIncome = $user->incomes()->whereMonth('date', $currentMonth)->whereYear('date', $currentYear)->sum('amount');
        $totalExpense = $user->expenses()->whereMonth('date', $currentMonth)->whereYear('date', $currentYear)->sum('amount');
        $recentIncomes = $user->incomes()->with('category')->latest()->take(5)->get();
        $recentExpenses = $user->expenses()->with('category')->latest()->take(5)->get();

        // ✅ TAMBAHKAN LOGIKA BARU UNTUK DATA GRAFIK
        // Ambil data pengeluaran per kategori untuk bulan ini
        $expenseByCategory = $user->expenses()
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('SUM(expenses.amount) as total'))
            ->groupBy('categories.name')
            ->orderBy('total', 'desc')
            ->get();

        // Siapkan data untuk ApexCharts
        $expenseChartData = [
            'labels' => $expenseByCategory->pluck('category_name')->toArray(),
            'series' => $expenseByCategory->pluck('total')->map(fn($val) => (float) $val)->toArray(),
        ];
        
        return view('admin.dashboard', compact(
            'totalBalance',
            'totalIncome',
            'totalExpense',
            'recentIncomes',
            'recentExpenses',
            'expenseChartData' // ✅ Kirim data grafik ke view
        ));
    }
}
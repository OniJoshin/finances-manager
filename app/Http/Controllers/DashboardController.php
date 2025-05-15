<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Current month's total
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $monthlyIncomeTotal = Income::where('user_id', $userId)
            ->whereBetween('received_at', [$monthStart, $monthEnd])
            ->sum('amount');

        // Latest 5 entries
        $recentIncomes = Income::where('user_id', $userId)
            ->orderByDesc('received_at')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('monthlyIncomeTotal', 'recentIncomes'));
    }
}

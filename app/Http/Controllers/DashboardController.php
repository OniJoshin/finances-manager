<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\Bill;
use App\Models\Budget;
use App\Models\SavingsGoal;
use App\Models\Category;
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

        $monthlyExpenseTotal = Expense::where('user_id', $userId)
            ->whereBetween('spent_at', [$monthStart, $monthEnd])
            ->sum('amount');

        $recentExpenses = Expense::where('user_id', $userId)
            ->latest('spent_at')
            ->limit(5)
            ->get();
        $billsThisMonth = Bill::where('user_id', $userId)
            ->where(function ($q) {
                $q->where('frequency', 'monthly')
                ->orWhere('frequency', 'yearly')
                ->whereMonth('next_due_date', now()->month);
            })
            ->orderBy('next_due_date')
            ->get();
        $monthlyBillsTotal = Bill::where('user_id', $userId)
            ->whereMonth('next_due_date', now()->month)
            ->whereYear('next_due_date', now()->year)
            ->sum('amount');
        $budgets = Budget::with('category')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($budget) use ($userId, $monthStart, $monthEnd) {
                $start = $budget->start_date ?? $monthStart;
                $end = $budget->end_date ?? $monthEnd;

                if ($budget->period === 'weekly') {
                    $start = now()->startOfWeek();
                    $end = now()->endOfWeek();
                }

                $spent = Expense::where('user_id', $userId)
                    ->where('category_id', $budget->category_id)
                    ->whereBetween('spent_at', [$start, $end])
                    ->sum('amount');

                $budget->spent = $spent;
                $budget->remaining = max(0, $budget->amount - $spent);
                $budget->percent_used = min(100, round(($spent / $budget->amount) * 100));
                $budget->status = match (true) {
                    $budget->percent_used >= 100 => 'over',
                    $budget->percent_used >= 90 => 'near',
                    default => 'under',
                };

                return $budget;
            });

            $goals = SavingsGoal::where('user_id', $userId)->get();

            $topCategories = Expense::where('user_id', $userId)
                ->whereBetween('spent_at', [$monthStart, $monthEnd])
                ->with('category')
                ->get()
                ->groupBy('category_id')
                ->map(function ($group) {
                    return [
                        'name' => optional($group->first()->category)->name ?? 'Uncategorised',
                        'total' => $group->sum('amount'),
                    ];
                })
                ->sortByDesc('total')
                ->take(5)
                ->values();

        return view('dashboard.index', compact('monthlyIncomeTotal', 'recentIncomes', 'monthlyExpenseTotal', 'recentExpenses', 'billsThisMonth', 'monthlyBillsTotal', 'budgets', 'goals', 'topCategories'));
    }
}

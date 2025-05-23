<?php

namespace App\Http\Controllers;

use App\Models\RecurringExpenseLog;
use Illuminate\Support\Facades\Auth;

class RecurringExpenseLogController extends Controller
{
    public function index()
    {
        $logs = RecurringExpenseLog::with(['recurringExpense', 'expense'])
            ->whereHas('recurringExpense', fn($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->paginate(20);

        return view('recurring-expense-logs.index', compact('logs'));
    }
}

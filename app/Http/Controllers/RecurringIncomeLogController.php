<?php

namespace App\Http\Controllers;

use App\Models\RecurringIncomeLog;
use Illuminate\Support\Facades\Auth;

class RecurringIncomeLogController extends Controller
{
    public function index()
    {
        $logs = RecurringIncomeLog::with(['recurringIncome', 'income'])
            ->whereHas('recurringIncome', fn($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->paginate(20);

        return view('recurring-income-logs.index', compact('logs'));
    }
}

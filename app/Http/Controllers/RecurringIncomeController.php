<?php

namespace App\Http\Controllers;

use App\Models\RecurringIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecurringIncomeController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $recurrings = RecurringIncome::where('user_id', Auth::id())->orderByDesc('created_at')->get();
        return view('recurring-incomes.index', compact('recurrings'));
    }

    public function create()
    {
        return view('recurring-incomes.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        RecurringIncome::create([
            'user_id' => Auth::id(),
            'source' => $request->source,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
            'start_date' => $request->start_date,
            'day_of_month' => $request->day_of_month ?? null,
            'notes' => $request->notes,
        ]);

        return redirect()->route('recurring-incomes.index')->with('success', 'Recurring income added.');
    }

    public function edit(RecurringIncome $recurringIncome)
    {
        $this->authorize('update', $recurringIncome);
        return view('recurring-incomes.edit', compact('recurringIncome'));
    }

    public function update(Request $request, RecurringIncome $recurringIncome)
    {
        $this->authorize('update', $recurringIncome);

        $request->validate($this->rules());

        $recurringIncome->update($request->only([
            'source', 'amount', 'frequency', 'start_date', 'day_of_month', 'notes'
        ]));

        return redirect()->route('recurring-incomes.index')->with('success', 'Recurring income updated.');
    }

    public function destroy(RecurringIncome $recurringIncome)
    {
        $this->authorize('delete', $recurringIncome);
        $recurringIncome->delete();

        return redirect()->route('recurring-incomes.index')->with('success', 'Recurring income deleted.');
    }

    private function rules(): array
    {
        return [
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:weekly,monthly',
            'start_date' => 'required|date',
            'day_of_month' => 'nullable|integer|min:1|max:31',
            'notes' => 'nullable|string',
        ];
    }
}

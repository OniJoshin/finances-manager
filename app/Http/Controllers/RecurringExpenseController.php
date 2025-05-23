<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RecurringExpense;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecurringExpenseController extends Controller
{
    public function index()
    {
        $recurrings = RecurringExpense::where('user_id', Auth::id())->latest()->get();
        return view('recurring-expenses.index', compact('recurrings'));
    }

    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();
        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('recurring-expenses.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $recurring = RecurringExpense::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
            'start_date' => $request->start_date,
            'day_of_month' => $request->day_of_month,
            'notes' => $request->notes,
            'category_id' => $request->category_id,
        ]);

        $recurring->tags()->sync($request->input('tags', []));


        return redirect()->route('recurring-expenses.index')->with('success', 'Recurring expense added.');
    }

    public function edit(RecurringExpense $recurringExpense)
    {
        $this->authorize('update', $recurringExpense);
        $categories = Auth::user()->categories()->orderBy('name')->get();
        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('recurring-expenses.edit', compact('recurringExpense', 'categories', 'tags'));
    }

    public function update(Request $request, RecurringExpense $recurringExpense)
    {
        $this->authorize('update', $recurringExpense);
        $request->validate($this->rules());

        $recurringExpense->update($request->only([
            'name', 'amount', 'frequency', 'start_date', 'day_of_month', 'notes', 'category_id'
        ]));

        $recurringExpense->tags()->sync($request->input('tags', []));


        return redirect()->route('recurring-expenses.index')->with('success', 'Recurring expense updated.');
    }

    public function destroy(RecurringExpense $recurringExpense)
    {
        $this->authorize('delete', $recurringExpense);
        $recurringExpense->delete();

        return redirect()->route('recurring-expenses.index')->with('success', 'Recurring expense deleted.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:weekly,monthly,yearly',
            'start_date' => 'required|date',
            'day_of_month' => 'nullable|integer|min:1|max:31',
            'notes' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}

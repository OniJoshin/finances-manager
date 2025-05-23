<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BudgetController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->orderBy('name')->get();
        return view('budgets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Budget::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget created.');
    }

    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);

        $categories = Category::where('user_id', Auth::id())->orderBy('name')->get();
        return view('budgets.edit', compact('budget', 'categories'));
    }

    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);

        $validated = $request->validate($this->rules());

        $budget->update($validated);

        return redirect()->route('budgets.index')->with('success', 'Budget updated.');
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Budget deleted.');
    }

    private function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'period' => 'required|in:monthly,weekly',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}

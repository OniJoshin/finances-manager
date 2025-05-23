<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())
            ->with('category', 'tags')
            ->latest('spent_at')
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();
        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('expenses.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $expense = Expense::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'amount' => $request->amount,
            'spent_at' => $request->spent_at,
            'category_id' => $request->category_id,
            'is_recurring' => $request->boolean('is_recurring'),
            'notes' => $request->notes,
        ]);

        $expense->tags()->sync($request->input('tags', []));

        return redirect()->route('expenses.index')->with('success', 'Expense added.');
    }

    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        $categories = Auth::user()->categories()->orderBy('name')->get();
        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('expenses.edit', compact('expense', 'categories', 'tags'));
    }

    public function update(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $request->validate($this->rules());

        $expense->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'spent_at' => $request->spent_at,
            'category_id' => $request->category_id,
            'is_recurring' => $request->boolean('is_recurring'),
            'notes' => $request->notes,
        ]);

        $expense->tags()->sync($request->input('tags', []));

        return redirect()->route('expenses.index')->with('success', 'Expense updated.');
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'spent_at' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_recurring' => 'sometimes|boolean',
            'notes' => 'nullable|string',
        ];
    }
}

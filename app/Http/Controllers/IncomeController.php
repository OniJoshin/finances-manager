<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IncomeController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $incomes = Income::where('user_id', Auth::id())->latest()->paginate(10);
        return view('income.index', compact('incomes'));
    }

    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();
        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('income.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());


        $income = Income::create(array_merge(
            $request->only(['source', 'amount', 'frequency', 'received_at', 'notes', 'category_id']),
            ['user_id' => Auth::id()]
        ));

        $income->tags()->sync($request->input('tags', []));

        return redirect()->route('income.index')->with('success', 'Income added.');
    }

    public function edit(Income $income)
    {
        $this->authorize('update', $income);
        $categories = Auth::user()->categories()->orderBy('name')->get();
        $tags = Auth::user()->tags()->orderBy('name')->get();

        return view('income.edit', compact('income', 'categories', 'tags'));
    }

    public function update(Request $request, Income $income)
    {
        $this->authorize('update', $income);

        $request->validate($this->rules());


        $income->update($request->only(['source', 'amount', 'frequency', 'received_at', 'notes', 'category_id']));

        
        $income->tags()->sync($request->input('tags', []));

        return redirect()->route('income.index')->with('success', 'Income updated.');
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', $income);
        $income->delete();
        return redirect()->route('income.index')->with('success', 'Income deleted.');
    }

    private function rules(): array
    {
        return [
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:one-time,weekly,monthly',
            'received_at' => 'required|date',
            'notes' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }

}

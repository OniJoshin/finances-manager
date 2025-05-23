<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BillController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $bills = Bill::where('user_id', Auth::id())
            ->with('tags')
            ->latest('next_due_date')
            ->paginate(10);

        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('bills.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $bill = Bill::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
            'next_due_date' => $request->next_due_date,
            'notes' => $request->notes,
        ]);

        $bill->tags()->sync($request->input('tags', []));

        return redirect()->route('bills.index')->with('success', 'Bill created.');
    }

    public function edit(Bill $bill)
    {
        $this->authorize('update', $bill);

        $tags = Auth::user()->tags()->orderBy('name')->get();
        return view('bills.edit', compact('bill', 'tags'));
    }

    public function update(Request $request, Bill $bill)
    {
        $this->authorize('update', $bill);
        $request->validate($this->rules());

        $bill->update([
            'name' => $request->name,
            'type' => $request->type,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
            'next_due_date' => $request->next_due_date,
            'notes' => $request->notes,
        ]);

        $bill->tags()->sync($request->input('tags', []));

        return redirect()->route('bills.index')->with('success', 'Bill updated.');
    }

    public function destroy(Bill $bill)
    {
        $this->authorize('delete', $bill);
        $bill->delete();

        return redirect()->route('bills.index')->with('success', 'Bill deleted.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:Utility,Subscription,Rent,Loan,Other',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:weekly,monthly,yearly',
            'next_due_date' => 'required|date',
            'notes' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}

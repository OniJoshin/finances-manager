<?php

namespace App\Http\Controllers;

use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SavingsGoalController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $goals = SavingsGoal::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        SavingsGoal::create([
            ...$request->only([
                'name',
                'target_amount',
                'current_amount',
                'monthly_contribution',
                'target_date',
                'notes',
            ]),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal created.');
    }

    public function edit(SavingsGoal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, SavingsGoal $goal)
    {
        $this->authorize('update', $goal);
        $request->validate($this->rules());

        $goal->update($request->only([
            'name',
            'target_amount',
            'current_amount',
            'monthly_contribution',
            'target_date',
            'notes',
        ]));

        return redirect()->route('goals.index')->with('success', 'Goal updated.');
    }

    public function destroy(SavingsGoal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0',
            'monthly_contribution' => 'nullable|numeric|min:0',
            'target_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}

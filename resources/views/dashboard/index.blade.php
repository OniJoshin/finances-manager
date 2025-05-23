<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- Monthly Summary (placeholder for income vs expense) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Monthly Summary</h2>
                <p class="text-sm text-gray-500">Income vs Expenses + Bills</p>
                <div class="mt-2 text-sm space-y-1">
                    <div class="text-green-600 font-semibold">Income: £{{ number_format($monthlyIncomeTotal, 2) }}</div>
                    <div class="text-red-600 font-semibold">Expenses: £{{ number_format($monthlyExpenseTotal, 2) }}</div>
                    <div class="text-orange-600 font-semibold">Bills: £{{ number_format($monthlyBillsTotal, 2) }}</div>
                    <div class="mt-1 text-blue-600 font-semibold">
                        Net (after expenses): £{{ number_format($monthlyIncomeTotal - $monthlyExpenseTotal, 2) }}
                    </div>
                    <div class="text-purple-600 font-semibold">
                        Projected Net (after bills): £{{ number_format($monthlyIncomeTotal - $monthlyExpenseTotal - $monthlyBillsTotal, 2) }}
                    </div>
                </div>
            </div>



            <!-- Upcoming Bills (placeholder) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Monthly Bills</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    @forelse ($billsThisMonth as $bill)
                        <li>
                            {{ $bill->name }} 
                            <span class="text-gray-500">({{ $bill->next_due_date->format('M j') }})</span>
                            <span class="text-red-600 font-semibold">£{{ number_format($bill->amount, 2) }}</span>
                        </li>
                    @empty
                        <li class="text-gray-400">No upcoming bills</li>
                    @endforelse
                </ul>
            </div>


            <!-- Income Overview (real data) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Income Overview</h2>
                <p class="text-sm text-gray-500">This Month</p>
                <div class="mt-2 text-green-600 font-bold text-xl">
                    £{{ number_format($monthlyIncomeTotal, 2) }}
                </div>
            </div>

            <!-- Budget Summary -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Budget Summary</h2>
                @forelse ($budgets as $budget)
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span>{{ $budget->category->name }}</span>
                            <span class="{{ $budget->status === 'over' ? 'text-red-600' : ($budget->status === 'near' ? 'text-yellow-600' : 'text-green-600') }}">
                                {{ $budget->percent_used }}% used
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                            <div class="h-2 rounded-full {{ $budget->status === 'over' ? 'bg-red-600' : ($budget->status === 'near' ? 'bg-yellow-400' : 'bg-green-500') }}"
                                style="width: {{ $budget->percent_used }}%"></div>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            £{{ number_format($budget->spent, 2) }} of £{{ number_format($budget->amount, 2) }}
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-gray-500">No active budgets set.</div>
                @endforelse
            </div>


            <!-- Financial Goals -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Financial Goals</h2>

                @forelse ($goals as $goal)
                    <div class="mb-3">
                        <div class="flex justify-between text-sm mb-1">
                            <span>{{ $goal->name }}</span>
                            <span class="text-blue-600">{{ $goal->percent_complete }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 bg-blue-500 rounded-full" style="width: {{ $goal->percent_complete }}%"></div>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            £{{ number_format($goal->current_amount, 2) }} of £{{ number_format($goal->target_amount, 2) }}
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No active savings goals.</p>
                @endforelse
            </div>


            <!-- Tags & Categories (placeholder) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Tags & Categories</h2>
                <p class="text-sm text-gray-500">Manage and apply to expenses</p>
                <div class="flex flex-wrap gap-2 mt-2 text-sm text-gray-500">
                    Coming soon
                </div>
            </div>

        </div>

        <!-- Recent Income -->
        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Recent Incomes</h2>
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Source</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentIncomes as $income)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $income->source }}</td>
                                <td class="px-4 py-2 text-green-600 font-semibold">£{{ number_format($income->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $income->received_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No income entries yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Recent Expenses</h2>
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentExpenses as $expense)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $expense->name }}</td>
                                <td class="px-4 py-2 text-red-600 font-semibold">£{{ number_format($expense->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $expense->spent_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No expense entries yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>

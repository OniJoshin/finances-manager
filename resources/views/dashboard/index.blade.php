<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- Monthly Summary (placeholder for income vs expense) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Monthly Summary</h2>
                <p class="text-sm text-gray-500">Income vs Expenses</p>
                <div class="mt-2 text-sm">
                    <div class="text-green-600 font-semibold">Income: £{{ number_format($monthlyIncomeTotal, 2) }}</div>
                    <div class="text-red-600 font-semibold">Expenses: £{{ number_format($monthlyExpenseTotal, 2) }}</div>
                    <div class="mt-1 text-blue-600 font-semibold">Net: £{{ number_format($monthlyIncomeTotal - $monthlyExpenseTotal, 2) }}</div>
                </div>
            </div>


            <!-- Upcoming Bills (placeholder) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Upcoming Bills</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li class="text-gray-400">Not implemented yet</li>
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

            <!-- Expenses Overview (placeholder) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Expenses Breakdown</h2>
                <div class="h-24 bg-gray-100 rounded mt-2 flex items-center justify-center text-gray-400">
                    Pie chart coming soon
                </div>
            </div>

            <!-- Financial Goals (placeholder) -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Financial Goals</h2>
                <p class="text-sm text-gray-500">Progress</p>
                <div class="mt-2 space-y-2">
                    <div class="bg-gray-100 p-2 rounded">
                        <span class="block text-sm">Holiday Fund</span>
                        <div class="w-full bg-gray-200 h-2 rounded-full">
                            <div class="bg-blue-500 h-2 rounded-full w-2/3"></div>
                        </div>
                    </div>
                </div>
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

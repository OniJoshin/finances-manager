<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Recurring Expense Logs</h1>

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Generated For</th>
                    <th class="px-4 py-2">Created</th>
                    <th class="px-4 py-2">Entry</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $log->recurringExpense->name }}</td>
                        <td class="px-4 py-2">{{ $log->generated_for_date->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('expenses.edit', $log->expense_id) }}"
                               class="text-blue-600 hover:underline">View Expense</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No logs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</x-app-layout>

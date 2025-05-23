<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Budgets</h1>
        <a href="{{ route('budgets.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full text-sm bg-white rounded-xl shadow overflow-hidden">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Period</th>
                <th class="px-4 py-2">Start</th>
                <th class="px-4 py-2">End</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($budgets as $budget)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $budget->category->name }}</td>
                    <td class="px-4 py-2">£{{ number_format($budget->amount, 2) }}</td>
                    <td class="px-4 py-2 capitalize">{{ $budget->period }}</td>
                    <td class="px-4 py-2">{{ $budget->start_date ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $budget->end_date ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('budgets.edit', $budget) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('budgets.destroy', $budget) }}" onsubmit="return confirm('Delete this budget?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-gray-500 py-4">No budgets found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $budgets->links() }}</div>
</x-app-layout>

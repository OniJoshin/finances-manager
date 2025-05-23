<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Expenses</h1>
        <a href="{{ route('expenses.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full text-sm bg-white rounded-xl shadow overflow-hidden">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Tags</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $expense->name }}</td>
                    <td class="px-4 py-2">£{{ number_format($expense->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ $expense->spent_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $expense->category->name ?? '—' }}</td>
                    <td class="px-4 py-2">
                        @foreach($expense->tags as $tag)
                            <span class="bg-gray-200 text-xs px-2 py-1 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('expenses.edit', $expense) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                              onsubmit="return confirm('Delete this expense?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-gray-500 py-4">No expenses found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $expenses->links() }}</div>
</x-app-layout>

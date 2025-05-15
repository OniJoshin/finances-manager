<x-app-layout>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Income</h1>
        <a href="{{ route('income.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Add Income
        </a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white border rounded overflow-hidden shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-4 py-2">Source</th>
                <th class="text-left px-4 py-2">Amount</th>
                <th class="text-left px-4 py-2">Category</th>
                <th class="text-left px-4 py-2">Tags</th>
                <th class="text-left px-4 py-2">Frequency</th>
                <th class="text-left px-4 py-2">Received</th>
                <th class="text-left px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incomes as $income)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $income->source }}</td>
                    <td class="px-4 py-2">£{{ number_format($income->amount, 2) }}</td>

                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $income->category->name ?? '—' }}
                    </td>

                    <td class="px-4 py-2 text-sm text-gray-600">
                        @if($income->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-1">
                                @foreach($income->tags as $tag)
                                    <span class="bg-gray-200 px-2 py-1 rounded text-xs">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @else
                            —
                        @endif
                    </td>

                    <td class="px-4 py-2 capitalize">{{ $income->frequency }}</td>
                    <td class="px-4 py-2">{{ $income->received_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <!-- Edit/Delete buttons -->
                        <a href="{{ route('income.edit', $income) }}" class="text-blue-600 hover:text-blue-800">
                            Edit
                        </a>
                        <form action="{{ route('income.destroy', $income) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this income?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr><td colspan="7" class="px-4 py-2 text-gray-500">No income entries found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $incomes->links() }}
    </div>
</x-app-layout>

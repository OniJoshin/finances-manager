<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Bills</h1>
        <a href="{{ route('bills.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full text-sm bg-white rounded-xl shadow overflow-hidden">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Due Date</th>
                <th class="px-4 py-2">Tags</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bills as $bill)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $bill->name }}</td>
                    <td class="px-4 py-2">{{ $bill->type }}</td>
                    <td class="px-4 py-2">£{{ number_format($bill->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ $bill->next_due_date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">
                        @foreach($bill->tags as $tag)
                            <span class="bg-gray-200 text-xs px-2 py-1 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('bills.edit', $bill) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('bills.destroy', $bill) }}" onsubmit="return confirm('Delete this bill?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-gray-500 py-4">No bills found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $bills->links() }}</div>
</x-app-layout>

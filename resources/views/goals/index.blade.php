<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Savings Goals</h1>
        <a href="{{ route('goals.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full text-sm bg-white rounded-xl shadow overflow-hidden">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Target</th>
                <th class="px-4 py-2">Saved</th>
                <th class="px-4 py-2">Progress</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($goals as $goal)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $goal->name }}</td>
                    <td class="px-4 py-2">£{{ number_format($goal->target_amount, 2) }}</td>
                    <td class="px-4 py-2">£{{ number_format($goal->current_amount, 2) }}</td>
                    <td class="px-4 py-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $goal->percent_complete }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $goal->percent_complete }}%</span>
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('goals.edit', $goal) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('goals.destroy', $goal) }}" onsubmit="return confirm('Delete this goal?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-gray-500 py-4">No savings goals yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $goals->links() }}</div>
</x-app-layout>

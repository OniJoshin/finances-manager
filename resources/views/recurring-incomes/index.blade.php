<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Recurring Incomes</h1>
        <a href="{{ route('recurring-incomes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <ul class="space-y-2">
        @forelse ($recurrings as $recurring)
            <li class="bg-white p-4 rounded shadow flex justify-between items-center">
                <div>
                    <div class="font-medium">{{ $recurring->source }}</div>
                    <div class="text-sm text-gray-600">
                        £{{ number_format($recurring->amount, 2) }} — {{ ucfirst($recurring->frequency) }}<br>
                        Started: {{ $recurring->start_date->format('Y-m-d') }}
                        @if ($recurring->last_generated_at)
                            <br>Last Generated: {{ $recurring->last_generated_at->format('Y-m-d') }}
                        @endif
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('recurring-incomes.edit', $recurring) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('recurring-incomes.destroy', $recurring) }}" onsubmit="return confirm('Delete this recurring income?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="text-gray-500">No recurring incomes set up.</li>
        @endforelse
    </ul>
</x-app-layout>

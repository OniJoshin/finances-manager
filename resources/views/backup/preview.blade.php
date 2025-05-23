<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Dry Run: Import Preview</h1>

    <div class="bg-yellow-100 border border-yellow-300 p-4 rounded mb-4 text-sm text-yellow-800">
        No data has been saved yet. This is a preview of what would happen if you proceed.
    </div>

    @if ($summary)
        <div class="bg-white shadow rounded-xl p-4 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($summary as $action)
                    <li>{{ $action }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mt-6">
            <a href="{{ route('backup.index') }}" class="text-blue-600 hover:underline">← Go back to Backup</a>
        </div>
    @else
        <p class="text-gray-500">No changes detected in the uploaded file.</p>
    @endif
</x-app-layout>

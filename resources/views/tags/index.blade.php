<x-app-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Tags</h1>
        <a href="{{ route('tags.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Add</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <ul class="space-y-2">
        @forelse ($tags as $tag)
            <li class="bg-white p-4 rounded shadow flex justify-between items-center">
                <span>{{ $tag->name }}</span>
                <div class="flex gap-2">
                    <a href="{{ route('tags.edit', $tag) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Delete this tag?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="text-gray-500">No tags found.</li>
        @endforelse
    </ul>
</x-app-layout>

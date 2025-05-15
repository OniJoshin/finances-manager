@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
               class="w-full border p-2 rounded" required>
        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitLabel ?? 'Save' }}
        </button>
    </div>
</div>

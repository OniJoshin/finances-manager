@csrf

<div class="space-y-4">

    <div>
        <label class="block text-sm font-medium">Source</label>
        <input type="text" name="source" value="{{ old('source', $income->source ?? '') }}"
               class="w-full border p-2 rounded" required>
        @error('source') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Amount</label>
        <input type="number" step="0.01" name="amount" value="{{ old('amount', $income->amount ?? '') }}"
               class="w-full border p-2 rounded" required>
        @error('amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Frequency</label>
        <select name="frequency" class="w-full border p-2 rounded" required>
            @foreach (['one-time', 'weekly', 'monthly'] as $option)
                <option value="{{ $option }}" @selected(old('frequency', $income->frequency ?? '') === $option)>
                    {{ ucfirst($option) }}
                </option>
            @endforeach
        </select>
        @error('frequency') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Date Received</label>
        <input type="date" name="received_at" value="{{ old('received_at', isset($income) ? $income->received_at->format('Y-m-d') : '') }}"
               class="w-full border p-2 rounded" required>
        @error('received_at') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded">{{ old('notes', $income->notes ?? '') }}</textarea>
        @error('notes') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Category</label>
        <select name="category_id" class="w-full border p-2 rounded">
            <option value="">-- None --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $income->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Tags</label>
        <select name="tags[]" multiple class="w-full border p-2 rounded">
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}"
                    @selected(collect(old('tags', isset($income) ? $income->tags->pluck('id') : []))->contains($tag->id))>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        @error('tags') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>



    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitLabel ?? 'Save' }}
        </button>
    </div>

</div>

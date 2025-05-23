@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input type="text" name="name"
            value="{{ old('name', $expense->name ?? '') }}"
            class="w-full border p-2 rounded" required>
        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Amount</label>
        <input type="number" name="amount" step="0.01"
               value="{{ old('amount', $expense->amount ?? '') }}"
               class="w-full border p-2 rounded" required>
        @error('amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Date</label>
        <input type="date" name="spent_at"
               value="{{ old('spent_at', isset($expense) ? $expense->spent_at->format('Y-m-d') : '') }}"
               class="w-full border p-2 rounded" required>
        @error('spent_at') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Category</label>
        <select name="category_id" class="w-full border p-2 rounded">
            <option value="">-- None --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $expense->category_id ?? '') == $category->id)>
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
                    @selected(collect(old('tags', isset($expense) ? $expense->tags->pluck('id') : []))->contains($tag->id))>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        @error('tags') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded">{{ old('notes', $expense->notes ?? '') }}</textarea>
        @error('notes') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitLabel ?? 'Save Expense' }}
        </button>
    </div>
</div>

@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', $bill->name ?? '') }}" required>
        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Category</label>
        <select name="category_id" class="w-full border p-2 rounded">
            <option value="">-- None --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $bill->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Amount</label>
        <input type="number" step="0.01" name="amount" class="w-full border p-2 rounded" value="{{ old('amount', $bill->amount ?? '') }}" required>
        @error('amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Frequency</label>
        <select name="frequency" class="w-full border p-2 rounded" required>
            @foreach(['weekly', 'monthly', 'yearly'] as $option)
                <option value="{{ $option }}" @selected(old('frequency', $bill->frequency ?? '') == $option)> {{ ucfirst($option) }} </option>
            @endforeach
        </select>
        @error('frequency') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Next Due Date</label>
        <input type="date" name="next_due_date" class="w-full border p-2 rounded" value="{{ old('next_due_date', isset($bill) ? $bill->next_due_date->format('Y-m-d') : '') }}" required>
        @error('next_due_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Tags</label>
        <select name="tags[]" multiple class="w-full border p-2 rounded">
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" @selected(collect(old('tags', isset($bill) ? $bill->tags->pluck('id') : []))->contains($tag->id))>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        @error('tags') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded">{{ old('notes', $bill->notes ?? '') }}</textarea>
        @error('notes') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitLabel ?? 'Save Bill' }}
        </button>
    </div>
</div>
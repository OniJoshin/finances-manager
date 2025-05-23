@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Category</label>
        <select name="category_id" class="w-full border p-2 rounded" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $budget->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Amount</label>
        <input type="number" step="0.01" name="amount" class="w-full border p-2 rounded" value="{{ old('amount', $budget->amount ?? '') }}" required>
        @error('amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Period</label>
        <select name="period" class="w-full border p-2 rounded" required>
            @foreach (['weekly', 'monthly'] as $option)
                <option value="{{ $option }}" @selected(old('period', $budget->period ?? '') == $option)>
                    {{ ucfirst($option) }}
                </option>
            @endforeach
        </select>
        @error('period') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Start Date</label>
        <input type="date" name="start_date" class="w-full border p-2 rounded" value="{{ old('start_date', $budget->start_date ?? '') }}">
        @error('start_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">End Date</label>
        <input type="date" name="end_date" class="w-full border p-2 rounded" value="{{ old('end_date', $budget->end_date ?? '') }}">
        @error('end_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ isset($budget) ? 'Update Budget' : 'Save Budget' }}
        </button>
    </div>
</div>

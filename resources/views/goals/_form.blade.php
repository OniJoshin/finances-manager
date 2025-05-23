@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded"
               value="{{ old('name', $goal->name ?? '') }}" required>
        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Target Amount</label>
        <input type="number" step="0.01" name="target_amount" class="w-full border p-2 rounded"
               value="{{ old('target_amount', $goal->target_amount ?? '') }}" required>
        @error('target_amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Current Amount</label>
        <input type="number" step="0.01" name="current_amount" class="w-full border p-2 rounded"
               value="{{ old('current_amount', $goal->current_amount ?? 0) }}">
        @error('current_amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Monthly Contribution</label>
        <input type="number" step="0.01" name="monthly_contribution" class="w-full border p-2 rounded"
               value="{{ old('monthly_contribution', $goal->monthly_contribution ?? '') }}">
        @error('monthly_contribution') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Target Date</label>
        <input type="date" name="target_date" class="w-full border p-2 rounded"
               value="{{ old('target_date', $goal->target_date ?? '') }}">
        @error('target_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded">{{ old('notes', $goal->notes ?? '') }}</textarea>
        @error('notes') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ isset($goal) ? 'Update Goal' : 'Save Goal' }}
        </button>
    </div>
</div>

@csrf
<div class="space-y-4">

    <div>
        <label class="block text-sm font-medium">Source</label>
        <input type="text" name="source" value="{{ old('source', $recurringIncome->source ?? '') }}" class="w-full border p-2 rounded" required>
        @error('source') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Amount</label>
        <input type="number" name="amount" step="0.01" value="{{ old('amount', $recurringIncome->amount ?? '') }}" class="w-full border p-2 rounded" required>
        @error('amount') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Frequency</label>
        <select name="frequency" class="w-full border p-2 rounded" required>
            @foreach(['weekly', 'monthly'] as $freq)
                <option value="{{ $freq }}" @selected(old('frequency', $recurringIncome->frequency ?? '') === $freq)>
                    {{ ucfirst($freq) }}
                </option>
            @endforeach
        </select>
        @error('frequency') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Start Date</label>
        <input type="date" name="start_date" value="{{ old('start_date', isset($recurringIncome) ? $recurringIncome->start_date->format('Y-m-d') : '') }}" class="w-full border p-2 rounded" required>
        @error('start_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Day of Month <small class="text-gray-500">(optional)</small></label>
        <input type="number" name="day_of_month" value="{{ old('day_of_month', $recurringIncome->day_of_month ?? '') }}" min="1" max="31" class="w-full border p-2 rounded">
        @error('day_of_month') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Notes</label>
        <textarea name="notes" class="w-full border p-2 rounded">{{ old('notes', $recurringIncome->notes ?? '') }}</textarea>
        @error('notes') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $submitLabel ?? 'Save' }}
        </button>
    </div>

</div>

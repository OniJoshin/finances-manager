<?php

namespace App\Exports;

use App\Models\RecurringIncome;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecurringIncomesSheetExport implements FromCollection, WithTitle, WithHeadings
{
    public function collection()
    {
        return RecurringIncome::with('tags')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($income) {
                return [
                    'id' => $income->id,
                    'user_id' => $income->user_id,
                    'source' => $income->source,
                    'amount' => $income->amount,
                    'frequency' => $income->frequency,
                    'start_date' => $income->start_date,
                    'day_of_month' => $income->day_of_month,
                    'notes' => $income->notes,
                    'last_generated_at' => $income->last_generated_at,
                    'created_at' => $income->created_at,
                    'updated_at' => $income->updated_at,
                    'category_id' => $income->category_id,
                    'tags' => $income->tags->pluck('name')->implode(', '),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Source',
            'Amount',
            'Frequency',
            'Start Date',
            'Day of Month',
            'Notes',
            'Last Generated At',
            'Created At',
            'Updated At',
            'Category ID',
            'Tags',
        ];
    }

    public function title(): string
    {
        return 'Recurring Incomes';
    }
}

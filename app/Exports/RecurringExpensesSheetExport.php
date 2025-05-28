<?php
namespace App\Exports;

use App\Models\RecurringExpense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecurringExpensesSheetExport implements FromCollection, WithTitle, WithHeadings
{
    public function collection()
    {
        return RecurringExpense::with('tags')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($expense) {
                return [
                    'id' => $expense->id,
                    'user_id' => $expense->user_id,
                    'name' => $expense->name,
                    'amount' => $expense->amount,
                    'frequency' => $expense->frequency,
                    'start_date' => $expense->start_date,
                    'day_of_month' => $expense->day_of_month,
                    'category_id' => $expense->category_id,
                    'notes' => $expense->notes,
                    'last_generated_at' => $expense->last_generated_at,
                    'created_at' => $expense->created_at,
                    'updated_at' => $expense->updated_at,
                    'tags' => $expense->tags->pluck('name')->implode(', '),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Name',
            'Amount',
            'Frequency',
            'Start Date',
            'Day Of Month',
            'Category ID',
            'Notes',
            'Last Generated At',
            'Created At',
            'Updated At',
            'Tags',
        ];
    }

    public function title(): string
    {
        return 'Recurring Expenses';
    }
}

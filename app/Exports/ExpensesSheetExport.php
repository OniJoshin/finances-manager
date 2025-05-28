<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpensesSheetExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Expense::with('tags')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($expense) {
                return [
                    'id' => $expense->id,
                    'user_id' => $expense->user_id,
                    'name' => $expense->name,
                    'amount' => $expense->amount,
                    'spent_at' => $expense->spent_at,
                    'category_id' => $expense->category_id,
                    'notes' => $expense->notes,
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
            'Spent At',
            'Category ID',
            'Notes',
            'Created At',
            'Updated At',
            'Tags',
        ];
    }

    public function title(): string
    {
        return 'Expenses';
    }
}

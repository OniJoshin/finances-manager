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
        return Expense::where('user_id', Auth::id())->get();
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
            'Updated At'
        ];
    }
    public function title(): string
    {
        return 'Expenses';
    }
}


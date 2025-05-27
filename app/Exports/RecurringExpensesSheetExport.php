<?php

namespace App\Exports;

use App\Models\RecurringExpense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecurringExpensesSheetExport implements FromCollection, WithTitle, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RecurringExpense::where('user_id', Auth::id())->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Recurring Expenses';
    }

    /**
     * @return array
     */
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
        ];
    }
}

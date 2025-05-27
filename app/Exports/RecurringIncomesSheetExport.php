<?php

namespace App\Exports;

use App\Models\RecurringIncome;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecurringIncomesSheetExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RecurringIncome::where('user_id', Auth::id())->get();
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Recurring Incomes';
    }
    /**
     * @return array
     */
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
        ];
    }
}

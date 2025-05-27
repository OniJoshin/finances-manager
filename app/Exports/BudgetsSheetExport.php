<?php

namespace App\Exports;

use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BudgetsSheetExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Budget::where('user_id', Auth::id())->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Budgets';
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Category ID',
            'Amount',
            'Period',
            'Start Date',
            'End Date',
            'Created At',
            'Updated At'
        ];
    }
}


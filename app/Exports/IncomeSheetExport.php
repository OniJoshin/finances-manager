<?php

namespace App\Exports;

use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncomeSheetExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Income::where('user_id', Auth::id())->get();
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Incomes';
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
            'Recieed At',
            'Notes',
            'Created At',
            'Updated At',
            'Category ID',
        ];
    }
}

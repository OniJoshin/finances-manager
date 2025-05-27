<?php

namespace App\Exports;

use App\Models\SavingsGoal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SavingsGoalsSheetExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SavingsGoal::where('user_id', Auth::id())->get();
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Savings Goals';
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
            'Target Amount',
            'Current Amount',
            'Monthly Contribution',
            'Target Date',
            'Notes',
            'Created At',
            'Updated At'
        ];
    }
}

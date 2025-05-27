<?php

namespace App\Exports;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BillsSheetExport implements FromCollection, WithTitle, WithHeadings
{
    public function collection()
    {
        return Bill::where('user_id', Auth::id())->get();
    }

    public function title(): string
    {
        return 'Bills';
    }
    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Name',
            'Amount',
            'Frequency',
            'Next Due Date',
            'Notes',
            'Created At',
            'Updated At'
        ];
    }
}


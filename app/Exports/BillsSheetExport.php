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
        return Bill::with('tags')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($bill) {
                return [
                    'id' => $bill->id,
                    'user_id' => $bill->user_id,
                    'name' => $bill->name,
                    'category_id' => $bill->category_id,
                    'amount' => $bill->amount,
                    'frequency' => $bill->frequency,
                    'next_due_date' => $bill->next_due_date,
                    'notes' => $bill->notes,
                    'created_at' => $bill->created_at,
                    'updated_at' => $bill->updated_at,
                    'tags' => $bill->tags->pluck('name')->implode(', '),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Name',
            'Category ID',
            'Amount',
            'Frequency',
            'Next Due Date',
            'Notes',
            'Created At',
            'Updated At',
            'Tags', // NEW
        ];
    }

    public function title(): string
    {
        return 'Bills';
    }
}


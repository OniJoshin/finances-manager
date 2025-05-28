<?php

namespace App\Exports;

use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncomeSheetExport implements FromCollection, WithTitle, WithHeadings
{
    public function collection()
    {
        return Income::with('tags') // eager-load tags
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($income) {
                return [
                    'id' => $income->id,
                    'user_id' => $income->user_id,
                    'source' => $income->source,
                    'amount' => $income->amount,
                    'frequency' => $income->frequency,
                    'received_at' => $income->received_at,
                    'notes' => $income->notes,
                    'created_at' => $income->created_at,
                    'updated_at' => $income->updated_at,
                    'category_id' => $income->category_id,
                    'tags' => $income->tags->pluck('name')->implode(', '), // NEW
                ];
            });
    }

    public function title(): string
    {
        return 'Incomes';
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Source',
            'Amount',
            'Frequency',
            'Received At',
            'Notes',
            'Created At',
            'Updated At',
            'Category ID',
            'Tags', // NEW
        ];
    }
}

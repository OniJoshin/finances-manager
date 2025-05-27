<?php

namespace App\Exports;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesSheetExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::where('user_id', Auth::id())->get();
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Categories';
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
            'Created At',
            'Updated At',
        ];
    }
}

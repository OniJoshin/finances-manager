<?php

namespace App\Exports;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TagsSheetExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tag::where('user_id', Auth::id())->get();
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Tags';
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

<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CategoriesSheetImport implements ToCollection, WithHeadingRow
{
    protected IdMappingRegistry $registry;

    public function __construct(IdMappingRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $category = Category::firstOrCreate([
                'user_id' => Auth::id(),
                'name' => $row['name'],
            ], [
                'description' => $row['description'] ?? null,
            ]);

            $this->registry->set('categories', $row['id'], $category->id);
        }
    }
}


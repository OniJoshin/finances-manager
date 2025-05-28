<?php

namespace App\Imports;

use App\Models\Budget;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BudgetsSheetImport implements ToCollection, WithHeadingRow
{
    protected IdMappingRegistry $registry;

    public function __construct(IdMappingRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $categoryId = $row['category_id'] ?? null;

            if ($categoryId && $this->registry->has('categories', $categoryId)) {
                $categoryId = $this->registry->get('categories', $categoryId);
            }

            Budget::updateOrCreate([
                'user_id' => Auth::id(),
                'category_id' => $categoryId,
                'start_date' => $row['start_date'],
            ], [
                'amount' => $row['amount'],
                'period' => $row['period'],
                'end_date' => $row['end_date'],
            ]);
        }
    }
}


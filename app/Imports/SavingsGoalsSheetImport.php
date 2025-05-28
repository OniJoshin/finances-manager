<?php

namespace App\Imports;

use App\Models\SavingsGoal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SavingsGoalsSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            SavingsGoal::updateOrCreate([
                'user_id' => Auth::id(),
                'name' => $row['name'],
            ], [
                'target_amount' => $row['target_amount'],
                'current_amount' => $row['current_amount'],
                'monthly_contribution' => $row['monthly_contribution'],
                'target_date' => $row['target_date'],
                'notes' => $row['notes'],
            ]);
        }
    }
}


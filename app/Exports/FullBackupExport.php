<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FullBackupExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new \App\Exports\CategoriesSheetExport(),
            new \App\Exports\TagsSheetExport(),
            new \App\Exports\ExpensesSheetExport(),
            new \App\Exports\IncomeSheetExport(),
            new \App\Exports\BillsSheetExport(),
            new \App\Exports\RecurringExpensesSheetExport(),
            new \App\Exports\RecurringIncomesSheetExport(),
            new \App\Exports\BudgetsSheetExport(),
            new \App\Exports\SavingsGoalsSheetExport(),
        ];
    }
}

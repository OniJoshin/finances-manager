<?php

namespace App\Imports;

use App\Imports\IdMappingRegistry;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FullBackupImport implements WithMultipleSheets
{
    protected IdMappingRegistry $registry;

    public function __construct()
    {
        $this->registry = new IdMappingRegistry();
    }
    
    public function sheets(): array
    {
        return [
            'Categories' => new CategoriesSheetImport($this->registry),
            'Tags' => new TagsSheetImport($this->registry),
            'Expenses' => new ExpensesSheetImport($this->registry),
            'Incomes' => new IncomesSheetImport($this->registry),
            'Bills' => new BillsSheetImport($this->registry),
            'Recurring Expenses' => new RecurringExpensesSheetImport($this->registry),
            'Recurring Incomes' => new RecurringIncomesSheetImport($this->registry),
            'Budgets' => new BudgetsSheetImport($this->registry),
            'Savings Goals' => new SavingsGoalsSheetImport($this->registry),
        ];
    }
}

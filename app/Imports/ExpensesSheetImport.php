<?php

namespace App\Imports;

use App\Models\Expense;
use App\Models\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ExpensesSheetImport implements ToCollection, WithHeadingRow
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

            $expense = Expense::updateOrCreate([
                'user_id' => Auth::id(),
                'name' => $row['name'],
                'spent_at' => $row['spent_at'],
            ], [
                'amount' => $row['amount'],
                'category_id' => $categoryId,
                'notes' => $row['notes'] ?? null,
            ]);

            if (!empty($row['tags'])) {
            $tagNames = array_filter(array_map('trim', explode(',', $row['tags'])));

            $tagIds = [];

            foreach ($tagNames as $name) {
                $tag = Tag::firstOrCreate([
                    'user_id' => Auth::id(),
                    'name' => strtolower($name),
                ]);
                $tagIds[] = $tag->id;
            }

            $expense->tags()->sync($tagIds); // or syncWithoutDetaching() if merging
        }
        }
    }
}


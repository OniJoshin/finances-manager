<?php

namespace App\Imports;

use App\Models\RecurringIncome;
use App\Models\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RecurringIncomesSheetImport implements ToCollection, WithHeadingRow
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

            $income = RecurringIncome::updateOrCreate([
                'user_id' => Auth::id(),
                'source' => $row['source'],
                'start_date' => $row['start_date'],
            ], [
                'amount' => $row['amount'],
                'frequency' => $row['frequency'],
                'day_of_month' => $row['day_of_month'],
                'notes' => $row['notes'],
                'last_generated_at' => $row['last_generated_at'],
                'category_id' => $categoryId,
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

                $income->tags()->sync($tagIds); // or syncWithoutDetaching() if merging
            }
        }
    }
}

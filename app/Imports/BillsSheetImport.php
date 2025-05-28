<?php

namespace App\Imports;

use App\Models\Bill;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BillsSheetImport implements ToCollection, WithHeadingRow
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

            $bill = Bill::updateOrCreate([
                'user_id' => Auth::id(),
                'name' => $row['name'],
                'next_due_date' => $row['next_due_date'],
            ], [
                'category_id' => $categoryId,
                'amount' => $row['amount'],
                'frequency' => $row['frequency'],
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

                $bill->tags()->sync($tagIds); // or syncWithoutDetaching() if merging
            }
        }
    }
}


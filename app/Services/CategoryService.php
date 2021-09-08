<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function getRelatedNameByTable(string $table): Collection
    {
        return DB::table($table)->select('categories.name')
            ->join('categories', "{$table}.cat_id", 'categories.id')
            ->pluck('name');
    }

    public function countNames(Collection $names): array
    {
        $categoriesWithCount = [];

        foreach ($names as $name) {
            if (isset($categoriesWithCount[$name])) {
                $categoriesWithCount[$name]++;
                continue;
            }

            $categoriesWithCount[$name] = 1;
        }

        return $categoriesWithCount;
    }
}

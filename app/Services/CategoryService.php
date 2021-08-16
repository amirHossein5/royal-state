<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function getAll(?int $whereNot = null, ?bool $withParent = null): Collection
    {
        return DB::table('categories')
            ->whereNull(['parent_id', 'deleted_at'])
            ->when($whereNot, fn ($q) => $q->where('id', '!=', $whereNot))
            ->get(['name', 'id']);
    }

    public function destroy(Category $category)
    {
        DB::transaction(function () use ($category) {
            $category->delete();

            Category::where('parent_id', $category->id)
                ->update(['parent_id' => null]);
        });
    }
}

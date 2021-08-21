<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function getAll()
    {
        return Cache::remember('allCategories', 60 * 60 * 24, function () {
            return DB::table('categories')
                ->whereNull(['deleted_at'])
                ->get(['name', 'id']);
        });
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

<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        Cache::put('allCategories', function () {
            DB::table('categories')
                ->whereNull(['deleted_at'])
                ->get(['name', 'id']);
        });
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        Cache::put('allCategories', function () {
            DB::table('categories')
                ->whereNull(['deleted_at'])
                ->get(['name', 'id']);
        });
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        Cache::put('allCategories', function () {
            DB::table('categories')
                ->whereNull(['deleted_at'])
                ->get(['name', 'id']);
        });
    }
}

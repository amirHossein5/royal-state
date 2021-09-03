<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','type','parent_id','url'];

    /**
     * Relations
     *
     */
    public function parent(): BelongsTo
    {
        return $this->BelongsTo(Menu::class);
    }

    /**
     * Scopes
     *
     */
    public function ScopeWithParent($query): Builder
    {
        return $query->addSelect([
            'parent_name' => DB::table('menus as parents')->select('name')
                ->whereColumn('menus.parent_id', 'parents.id')
        ]);
    }
}

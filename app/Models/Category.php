<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id'
    ];

    /**
     * relations
     *
     */
    public function chilren()
    {
        return $this->hasMany(Category::class)->with('children');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * scopes
     *
     */
    public function scopeWithParent($builder)
    {
        return $builder->addSelect([
            'parent_name' =>
            DB::table('categories as parents')
                ->select('name')
                ->whereColumn('categories.parent_id', 'parents.id')
        ]);
    }
}

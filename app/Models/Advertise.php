<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertise extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'address', 'amount', 'image', 'floor', 'year', 'storeroom', 'balcony', 'area', 'room', 'parking', 'toilet', 'tag', 'type', 'sell_status', 'cat_id', 'user_id', 'approved', 'be_on_slider'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
        'image' => 'array',
        'storeroom' => 'boolean',
        'balcony' => 'boolean',
        'parking' => 'boolean',
        'sell_status' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeWithOwner($builder)
    {
        return $builder->with(['owner' => fn ($q) => $q->select('id', 'first_name', 'last_name')]);
    }

    public function scopeWithCategory($builder)
    {
        return $builder->with(['category' => fn ($q) => $q->select('name', 'id')]);
    }
}

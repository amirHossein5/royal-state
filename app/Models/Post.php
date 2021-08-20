<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'cat_id',
        'user_id',
        'published_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'array',
        'published_at' => 'date:Y-m-d'
    ];

    /**
     * relations
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Accessors
     *
     */


    /**
     * scopes
     *
     */
    public function scopeWithCategory($query)
    {
        return $query->addSelect([
            'category_name' => Category::select('name')
                ->whereColumn('categories.id', 'posts.cat_id')
        ]);
    }

    public function scopeWithAuthor($query)
    {
        return $query->with('author:first_name,last_name,id');
    }
}

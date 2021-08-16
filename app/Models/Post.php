<?php

namespace App\Models;

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
        'title', 'body', 'image', 'cat_id', 'user_id', 'published_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'array'
    ];

    protected $dates = ['published_at'];

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

    public function getCustomFormatAttribute(object $published_at)
    {
        dd(1);
        return $published_at->format('Y-m-d');
    }

    public function scopeWithCategory($builder)
    {
        return $builder->with(['category' => fn ($q) => $q->select('id', 'name')]);
    }

    public function scopeWithAuthor($builder)
    {
        return $builder->with(['author' => fn ($q) => $q->select('first_name', 'last_name', 'id')]);
    }
}

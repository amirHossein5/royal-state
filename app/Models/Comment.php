<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id', 'parent_id', 'comment', 'approved'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * Relations.
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')
            ->latest()
            ->with('user:id,first_name,last_name')
            ->with('children');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Accessors.
     *
     */
    public function getApprovedStatusMinimalAttribute(): string
    {
        return $this->approved
            ? 'فعال'
            : 'غیرفعال';
    }

    public function getApprovedStatusAttribute(): string
    {
        return $this->approved
            ? '<span class="text-success">فعال</span>'
            : '<span class="text-danger">غیرفعال</span>';
    }

    public function getApprovedButtonAttribute(): string
    {
        return $this->approved
            ? '<button type="submit" class="btn btn-danger waves-effect waves-light">لغو تایید</button>'
            : '<button type="submit" class="btn btn-success waves-effect waves-light">تایید</button>';
    }
}

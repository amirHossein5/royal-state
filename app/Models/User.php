<?php

namespace App\Models;

use App\Traits\HasAuthorization;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasAuthorization;

    public const USER_ROLE = 1;
    public const ADMIN_ROLE = 2;
    public const AUTHOR_ROLE = 3;
    public const SALES_EXPERT_ROLE = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'social_id',
        'social_type',
        'email_verified_at',
        'phone',
        'show_phone_number',
        'show_email',
        'last_visited_at',
        'delete_account_after'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'approved' => 'boolean'
    ];

    /**
     * relations.
     *
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function advertises(): HasMany
    {
        return $this->hasMany(Advertise::class, 'user_id', 'id')->withTrashed();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * accessors
     *
     */
    public function hasAdvertise(int $id): Bool
    {
        return in_array($id, $this->advertises->map(fn ($item) => $item->id)->toArray());
    }

    public function getFullNameAttribute(): String
    {
        return $this->first_name . ' ' . $this->last_name;
    }

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

    /**
     * Scopes
     *
     */
    public function scopeWhereId($query, string $operator, int $id): QueryBuilder
    {
        return $query->where('id', $operator, $id);
    }
}

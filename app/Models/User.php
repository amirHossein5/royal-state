<?php

namespace App\Models;

use App\Traits\Authorizable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Authorizable;

    public const USER_ROLE = 1;
    public const ADMIN_ROLE = 2;

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
        'email_verified_at'
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
    ];

    /**
     * relations.
     *
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }

    /**
     * accessors
     *
     */
    public function getHasAdvertiseAttribute(int $id): Bool
    {
        return in_array($id, $this->advertises->map(fn ($item) => $item->id)->toArray());
    }

    public function getFullNameAttribute(): String
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getApprovedAttribute(): String
    {
        return $this->approved
            ? 'فعال'
            : 'غیرفعال';
    }
}

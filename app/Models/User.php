<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     *
     *
     */
    public function hasPermission(string $permission): Bool
    {
        return $this->role->permissions->contains('name', $permission) || $this->permissions->contains('name', $permission);
    }

    public function addPermission(string $permission)
    {
        $permissionId = Permission::givePermissionId($permission);

        return $this->permissions()->attach($permissionId);
    }

    public function isAdmin(): Bool
    {
        return $this->role->id === self::ADMIN_ROLE;
    }

    public function hasAdvertise(int $id): Bool
    {
        return in_array($id, $this->advertises->map(fn ($item) => $item->id)->toArray());
    }

    public function getFullNameAttribute(): String
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function approved(): String
    {
        return $this->attributes['approved']
            ? 'فعال'
            : 'غیرفعال';
    }
}

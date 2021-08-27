<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    /**
     * Relations.
     *
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Scopes.
     *
     */
    public function scopeGivePermissionId($query, string $permission): int
    {
        $id = $query->where('name', $permission)->first()->id;

        if (!$id) {
            return "{$permission} not found.";
        }

        return $id;
    }
}

<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use stdClass;

trait HasAuthorization
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role->name === $roleName;
    }

    public function getAllPermissionsAttribute()
    {
        return
            $this->permissions->merge($this->role->permissions);
    }

    public function isAdmin(): Bool
    {
        return $this->role->id === self::ADMIN_ROLE;
    }

    public function hasPermission(string $permission): Bool
    {
        return $this->allPermissions->contains('name', $permission);
    }

    public function addPermission(string $permission): mixed
    {
        $permissionId = Permission::givePermissionId($permission);

        return $this->permissions()->attach($permissionId);
    }
}

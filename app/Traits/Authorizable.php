<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait Authorizable
{
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
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
        return $this->allPermissions->contains('name',$permission);
    }

    public function addPermission(string $permission)
    {
        $permissionId = Permission::givePermissionId($permission);

        return $this->permissions()->attach($permissionId);
    }
}

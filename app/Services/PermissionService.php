<?php

namespace App\Services;

class PermissionService
{
    public function getPermissionsFrom(?array $permissions): ?array
    {
        if (!$permissions) {
            return null;
        }

        $permissions = $permissions;

        foreach ($permissions as $permission) {
            $model = explode('_', $permission);

            $model  = $model[0]  . '_view_any';

            in_array($model, $permissions) ?: $permissions[] = $model;
        }

        return array_values($permissions);
    }
}

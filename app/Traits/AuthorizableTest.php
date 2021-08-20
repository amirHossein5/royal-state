<?php

namespace App\Traits;

use App\Models\User;

trait AuthorizableTest
{
    public function actWithPermission(array|string $permissions): User
    {
        $user = User::factory()->create();

        if (is_array($permissions)) {
            $this->addMultiplePermissions($user, $permissions);
        }else{
            $this->addOnePermission($user, $permissions);
        }

        $this->actingAs($user);
        return $user;
    }

    public function actWithRole(int $role_id): User
    {
        $user = User::factory()->create(['role_id' => $role_id]);
        $this->actingAs($user);

        return $user;
    }

    private function addOnePermission(object $user, string $permission): Void
    {
        $user->addPermission($permission);
    }

    private function addMultiplePermissions(object $user, array $permissions): Void
    {
        foreach ($permissions as $permission) {
            $user->addPermission($permission);
        }
    }
}

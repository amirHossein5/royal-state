<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AssignRolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class
        ]);

        $userRole = Role::findByname('user');
        $userRole->permissions()->attach([20, 21, 23, 24, 25, 26, 27]);

        $authorRole = Role::findByname('author');
        $authorRole->permissions()->attach([7, 9, 10, 11, 12, 13, 14, 15, 16, 18, 19]);

        $salesRole = Role::findByname('sales expert');
        $salesRole->permissions()->attach([20, 22, 23, 24, 25, 26, 27]);
    }
}

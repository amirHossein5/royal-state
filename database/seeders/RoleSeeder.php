<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'user', 'display_name' => 'کاربر عادی'],
            ['name' => 'admin', 'display_name' => 'ادمین'],
            ['name' => 'author', 'display_name' => 'نویسنده'],
            ['name' => 'sales expert', 'display_name' => 'کارشناس فروش']
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'display_name' => $role['display_name']
            ]);
        }
    }
}

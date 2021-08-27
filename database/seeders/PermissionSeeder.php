<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'category_view_any',
            'category_create',
            'category_update',
            'category_delete',
            'category_restore',
            'category_force_delete',

            'post_view_any',
            'post_access_all',
            'post_view',
            'post_create',
            'post_update',
            'post_delete',
            'post_restore',
            'post_force_delete',

            'comment_view_any',
            'comment_view',
            'comment_view_all',
            'comment_reply',
            'comment_approved',

            'advertise_view_any',
            'advertise_view',
            'advertise_access_all',
            'advertise_create',
            'advertise_update',
            'advertise_delete',
            'advertise_restore',
            'advertise_force_delete',

            'slide_view_any',
            'slide_add',

            'user_view_any',
            'user_approved',
            'user_update',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

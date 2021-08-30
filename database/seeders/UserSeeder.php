<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user Role
        User::create([
            'first_name'             => 'user',
            'last_name'              => 'karimi',
            'email'                  => 'user@gmail.com',
            'email_verified_at'      => now(),
            'password'               => bcrypt('user@gmail.com')
        ]);

        //admin Role
        User::create([
            'first_name'             => 'admin',
            'last_name'              => 'karimi',
            'email'                  => 'admin@gmail.com',
            'email_verified_at'      => now(),
            'password'               => bcrypt('admin@gmail.com'),
            'role_id'                => User::ADMIN_ROLE
        ]);

        //author Role
        User::create([
            'first_name'             => 'author',
            'last_name'              => 'karimi',
            'email'                  => 'author@gmail.com',
            'email_verified_at'      => now(),
            'password'               => bcrypt('author@gmail.com'),
            'role_id'                => User::AUTHOR_ROLE
        ]);

        //sales expert Role
        User::create([
            'first_name'             => 'sales',
            'last_name'              => 'karimi',
            'email'                  => 'sales@gmail.com',
            'email_verified_at'      => now(),
            'password'               => bcrypt('sales@gmail.com'),
            'role_id'                => User::SALES_EXPERT_ROLE
        ]);
    }
}

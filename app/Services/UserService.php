<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function register(object $user): User
    {
        $emailVerifiedAt = $user->email_verified === true
            ? now()->toDateTimeString()
            : '';

        return User::create([
            'first_name' => $user->given_name,
            'last_name' => $user->family_name,
            'email' => $user->email,
            'email_verified_at' => $emailVerifiedAt,
            'social_id' => $user->id,
            'social_type' => 'google',
        ]);
    }
}

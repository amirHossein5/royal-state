<?php

namespace App\Services;

use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\User;

class AuthService
{
    private static $user;

    public static function loginOrRegister(): Void
    {
        $findUser = UserModel::where('social_id', self::$user->id)->first();

        if ($findUser) {
            Auth::login($findUser);
            return;
        }

        $user = self::register((object) self::$user->user);
        Auth::login($user);
    }

    public static function register(object $user): UserModel
    {
        $emailVerifiedAt = $user->email_verified === true
            ? now()->toDateTimeString()
            : '';

        return UserModel::create([
            'first_name' => $user->given_name,
            'last_name' => $user->family_name,
            'email' => $user->email,
            'email_verified_at' => $emailVerifiedAt,
            'social_id' => $user->id,
            'social_type' => 'google',
        ]);
    }

    public static function setUser(User $user): AuthService
    {
        self::$user = (object) $user;
        return new static();
    }
}

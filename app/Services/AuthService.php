<?php

namespace App\Services;

use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Two\User;

class AuthService
{
    private static $user;
    private static $message;

    public static function loginOrRegister(bool $socialite_register = true): AuthService|string
    {
        if ($socialite_register) {

            $findUser = UserModel::where(function($query){
                $query->Orwhere('social_id', self::$user->id);
                $query->Orwhere('email',self::$user->email);
            })->first();

        } else {
            $findUser = UserModel::where('email', self::$user->email)->first();
        }

        if ($findUser) {

            if (!$socialite_register) {

                if (!Hash::check(self::$user->password, $findUser->password)) {
                    self::$message = __('auth.failed');

                    return new static();
                }
            }

            self::$user = $findUser;
            Auth::login($findUser);
            return new static();
        }

        if ($socialite_register) {
            $user = self::register((object) self::$user->user);
        } else {
            $user = self::simpleRegister((object) self::$user);
        }

        self::$user = $user;
        Auth::login($user);

        return new static();
    }

    private static function checkPassword(string $hashedPassword, string $password): bool
    {
        return Hash::check($password, $hashedPassword);
    }

    public static function simpleRegister(object $user): UserModel
    {
        return UserModel::create([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => bcrypt($user->password)
        ]);
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

    public static function get(): UserModel|string
    {
        return self::$message ?? self::$user;
    }

    public static function setUser(User|array $user): AuthService
    {
        self::$user = (object) $user;

        return new static();
    }
}

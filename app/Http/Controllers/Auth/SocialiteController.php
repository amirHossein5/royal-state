<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(string $driver): RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleCallback(string $driver): RedirectResponse|String
    {
        try {
            $user = Socialite::driver($driver)->user();

            AuthService::setUser($user)->loginOrRegister();

            return redirect()->route('dashboard.index');
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}

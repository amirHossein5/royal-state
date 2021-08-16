<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $findUser = User::where('social_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect()->route('dashboard.index');
            }

            $user = (new UserService)->register((object) $user->user);

            Auth::login($user);
            return redirect()->route('dashboard.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

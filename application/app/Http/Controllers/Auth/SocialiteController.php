<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    public function index($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function show($provider)
    {
        $authenticated = Socialite::driver($provider)->user();

        $user = User::firstOrCreate([
            'email' => $authenticated->getEmail()
        ], [
            'name' => $authenticated->getName(),
            'profile_photo_path' => $authenticated->getAvatar()
        ]);

        Cache::put(get_class($user) . ":{$user->id}.github.token", $authenticated->token);
        Auth::login($user);
        return redirect()->to('dashboard');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        Auth::login($user);
        return redirect()->to('dashboard');
    }
}

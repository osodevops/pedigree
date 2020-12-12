<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    public function index($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function show($provider)
    {
        $user = Socialite::driver($provider)->user();

        dd($user);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\GitHub\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    /**
     * Redirect the user to the given Authentication route.
     *
     * @param  string  $provider
     * @return \Illuminate\Http\Response
     */
    public function index($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle the callback and log the user in to the application.
     *
     * @param  string  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($provider)
    {
        $authenticated = Socialite::driver($provider)->user();

        $user = User::firstOrCreate([
            'email' => $authenticated->getEmail()
        ], [
            'name' => $authenticated->getName(),
            'profile_photo_path' => $authenticated->getAvatar()
        ]);

        (new AuthService($user))->setToken($authenticated->token);
        Auth::login($user);
        return redirect()->to('dashboard');
    }
}

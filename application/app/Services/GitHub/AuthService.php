<?php

namespace App\Services\GitHub;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    /**
     * The user authenticating with the Service.
     *
     * @param  \App\Models\User|null  $user
     * @return void
     */
    public function __construct(?User $user = null)
    {
        $this->authenticated = $user;
    }

    public function getAuthHeader()
    {
        if (is_null($this->authenticated)) {
            return "Bearer " . config('services.github.server_key');
        }

        return "Bearer {$this->getToken()}";
    }

    /**
     * Get the key used to interact with the cache.
     *
     * @return string
     */
    protected function getTokenCacheKey()
    {
        return get_class($this->authenticated) . ":{$this->authenticated->id}.github.token";
    }

    /**
     * Get the API Access Token from storage.
     *
     * @return string
     */
    public function getToken()
    {
        return Cache::get($this->getTokenCacheKey());
    }

    /**
     * Put the API Access Token in storage.
     *
     * @param  string  $token
     * @return void
     */
    public function setToken($token)
    {
        Cache::put($this->getTokenCacheKey(), $token);
    }
}

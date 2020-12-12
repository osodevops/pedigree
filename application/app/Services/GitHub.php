<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use App\Services\GitHub\AuthService;
use App\Services\GitHub\RepositoriesService;

class GitHub
{
    /**
     * HTTP Client pre-configured with authentication.
     *
     * @var \GuzzleHttp\Client
     */
    protected Client $client;

    /**
     * Authentication service to handle API Authentication.
     *
     * @var \App\Services\GitHub\AuthService
     */
    protected $auth;

    /**
     * Authenticate with the API as the given user.
     *
     * @param  \App\Models\User  $user
     * @return $this
     */
    public function authenticateAs(User $user)
    {
        $this->auth = new AuthService($user);
        return $this;
    }

    /**
     * Get an instance of the repositories service.
     *
     * @param  string  $username
     * @param  string  $name
     * @return App\Services\GitHub\RepositoriesService
     */
    public function repository($username, $name)
    {
        return (new RepositoriesService($this))
            ->setRepository($username, $name);
    }

    /**
     * Make a Http Request.
     *
     * @param  string  $method
     * @param  string  $url
     * @return array
     */
    public function request($method, $url)
    {
        $response = $this->getHttpClient()->request($method, "https://api.github.com/{$url}")
            ->getBody()
            ->getContents();

        return json_decode($response, true);
    }

    /**
     * Get the HTTP client used to make requests.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if ($this->client ?? null) {
            return $this->client;
        }

        return $this->client = new Client([
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json',
                'Authorization' => "Bearer " . $this->auth->getToken()
            ]
        ]);
    }
}

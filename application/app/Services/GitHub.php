<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\GitHub\RepositoriesService;

class GitHub
{
    /** @var string */
    private string $personalAccessToken;

    /**
     * HTTP Client pre-configured with authentication.
     *
     * @var \GuzzleHttp\Client
     */
    protected Client $client;

    /**
     * Create a new instance of the service.
     *
     * @param  string  $personalAccessToken
     * @return void
     */
    public function __construct($personalAccessToken)
    {
        $this->personalAccessToken = $personalAccessToken;
        $this->client = new Client([
            'headers' => [
                'Authorization' => "token {$personalAccessToken}",
                'Accept' => 'application/vnd.github.v3+json',
            ]
        ]);
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
        $response = $this->client->request($method, "https://api.github.com/{$url}")
            ->getBody()
            ->getContents();

        return json_decode($response, true);
    }
}

<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use App\Services\GitHub\StatsService;
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
     * Get an instance of the statistics service.
     *
     * @return App\Services\GitHub\StatsService
     */
    public function stats()
    {
        return (new StatsService($this));
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
        return $this->client = new Client([
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json',
                'Authorization' => "Bearer " . config('services.github.server_key'),
            ]
        ]);
    }
}

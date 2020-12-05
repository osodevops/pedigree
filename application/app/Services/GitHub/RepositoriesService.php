<?php

namespace App\Services\GitHub;

use App\Services\GitHub;

class RepositoriesService
{
    /** @var string */
    public string $username;

    /** @var string */
    public string $name;

    /** @var \App\Services\GitHub */
    protected GitHub $service;

    public function __construct(GitHub $service)
    {
        $this->service = $service;
    }

    /**
     * Set the base repository for the service.
     *
     * @param  string  $username
     * @param  string  $name
     * @return $this
     */
    public function setRepository(string $username, string $name)
    {
        $this->username = $username;
        $this->name = $name;

        return $this;
    }

    /**
     * Get the repository from the GitHub API.
     *
     * @return array
     */
    public function get()
    {
        return $this->service->request(
            'GET',
            "repos/{$this->username}/{$this->name}"
        );
    }

    /**
     * Get issues for this repository from the GitHub API.
     *
     * @param  array  $query
     * @return array
     */
    public function issues(array $query = [])
    {
        $queryString = http_build_query($query);

        return $this->service->request(
            'GET',
            "repos/{$this->username}/{$this->name}/issues?{$queryString}"
        );
    }

    /**
     * Get commits for this repository from the GitHub API.
     *
     * @param  array  $query
     * @return array
     */
    public function commits(array $query = [])
    {
        $queryString = http_build_query($query);

        return $this->service->request(
            'GET',
            "repos/{$this->username}/{$this->name}/commits?{$queryString}"
        );
    }

    /**
     * Compare a branch from this repository with another branch.
     *
     * @param  string  $base
     * @param  string  $head
     * @return array
     */
    public function compare(string $base, string $head)
    {
        return $this->service->request(
            'GET',
            "repos/{$this->username}/{$this->name}/compare/{$base}...{$head}"
        );
    }
}

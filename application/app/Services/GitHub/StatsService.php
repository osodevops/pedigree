<?php

namespace App\Services\GitHub;

use App\Services\GitHub;

class StatsService
{
    /** @var \App\Services\GitHub */
    protected GitHub $service;

    public function __construct(GitHub $service)
    {
        $this->service = $service;
    }

    /**
     * Get the commit activity for the given repository.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return array
     */
    public function commits($user, $repository)
    {
        return $this->service->request(
            'GET',
            "repos/{$user}/{$repository}/stats/commit_activity"
        );
    }
}

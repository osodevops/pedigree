<?php

namespace App\Http\Controllers\Statistics;

use App\Services\GitHub;
use App\Http\Resources\Statistics\CommitsResource;

class CommitController
{
    /**
     * Create a new instance of the controller.
     *
     * @param  \App\Services\GitHub  $service
     * @return void
     */
    public function __construct(GitHub $service)
    {
        $this->service = $service;
    }

    /**
     * Retrieve commit statistics for a given repository.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     */
    public function show($user, $repository)
    {
        return CommitsResource::make(
            $this->service->stats()->commits($user, $repository)
        );
    }
}

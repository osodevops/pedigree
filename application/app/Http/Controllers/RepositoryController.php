<?php

namespace App\Http\Controllers;

use App\Services\GitHub;
use App\Http\Resources\RepositoryResource;

class RepositoryController
{
    /** @var \App\Services\GitHub */
    private $service;

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
     * Retrieve a single repository.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     */
    public function show($user, $repository)
    {
        return RepositoryResource::make(
            $this->service->authenticateAs(auth()->user())->repository($user, $repository)->get()
        );
    }
}

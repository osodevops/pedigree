<?php

namespace App\Http\Controllers;

use App\Services\GitHub;
use App\Http\Resources\RepositoryResource;

class ForkController
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
     * Retrieve the repositories forked off the base repository.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     */
    public function index($user, $repository)
    {
        $baseRepository = $this->service->repository($user, $repository);
        return collect($baseRepository->forks())
            ->map(function ($repository) use ($baseRepository) {
                try {
                    $repository['difference'] = $baseRepository->compare(
                        $repository['default_branch'],
                        "{$repository['owner']['login']}:{$repository['default_branch']}"
                    );
                    // $repository['difference'] = $this->service->repository($repository['owner']['login'], $repository['name'])
                    //     ->compare(
                    //         $repository['default_branch'],
                    //         "{$baseRepository->getUsername()}:{$repository['default_branch']}"
                    //     );
                } catch (\Exception $e) {
                    // Do nothing
                }
                return RepositoryResource::make($repository);
            });
    }
}

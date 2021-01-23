<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Services\GitHub;
use App\Models\Difference;
use App\Models\Repository;
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
        $base = Repository::where('name', $repository)
            ->where('owner_id', $user)
            ->firstOrFail();

        $baseRepository = $this->service->repository($user, $repository);

        $queryOptions = [
            'per_page' => request('per_page', 50),
            'page' => request('page', 1)
        ];

        $forks = RepositoryResource::collection(
            $this->service->repository($user, $repository)->forks($queryOptions)
        );

        return tap($forks->toArray(request()), function ($forks) use ($base) {
            foreach ($forks as $fork) {
                $owner = Owner::firstOrCreate(['id' => $fork['owner']['name']], $fork['owner']);
                $fork = $owner->repositories()->updateOrCreate(
                    ['id' => $fork['id']],
                    $fork + ['parent_id' => $base['id']]
                );

                Difference::updateOrCreate([
                    'base_repository_id' => $base['id'],
                    'repository_id' => $fork['id'],
                ], [
                    'status' => 'unknown',
                ])
                ->setRelations([
                    'baseRepository' => $base,
                    'repository' => $fork
                ]);
            }
        });
    }
}

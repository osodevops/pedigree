<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Owner;
use App\Services\GitHub;
use Illuminate\Http\Request;
use App\Http\Resources\RepositoryResource;
use App\Exceptions\RepositoryNotFoundException;

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
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $user
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     *
     * @throws App\Exceptions\RepositoryNotFoundException
     */
    public function show(Request $request, $user, $repository)
    {
        try {
            $resource = RepositoryResource::make(
                $this->service->authenticateAs(auth()->user())->repository($user, $repository)->get()
            );
        } catch (Exception $e) {
            dd($e);
            RepositoryNotFoundException::throw($user, $repository);
        }

        return tap($resource->toArray($request), function ($repository) {
            $owner = Owner::updateOrCreate(['id' => $repository['owner']['name']], $repository['owner']);
            $owner->repositories()->updateOrCreate(['id' => $repository['id']], $repository);
        });
    }
}

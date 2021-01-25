<?php

namespace App\Http\Controllers\Statistics;

use App\Services\GitHub;
use App\Http\Resources\Statistics\LanguagesResource;

class LanguageController
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
     * Retrieve language statistics for a given repository.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     */
    public function show($user, $repository)
    {
        return LanguagesResource::make(
            $this->service->stats()->languages($user, $repository)
        );
    }
}

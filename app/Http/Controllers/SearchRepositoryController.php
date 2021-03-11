<?php

namespace App\Http\Controllers;

use App\Services\GitHub;
use Illuminate\Http\Request;
use App\Http\Resources\RepositoryResource;

class SearchRepositoryController
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
     * Search for repositories by keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return RepositoryResource::collection(
            $this->service->repository()->search([
                'q' => $request->get('q', ''),
                'per_page' => $request->get('per_page', 3),
            ])['items']
        );
    }
}

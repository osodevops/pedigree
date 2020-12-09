<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RepositoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $repository = $this->resource;
        return [
            'id' => $repository['id'],
            'name' => $repository['name'],
            'description' => $repository['description'],
            'url' => $repository['html_url'],
            'default_branch' => $repository['default_branch'],
            'owner' => [
                'id' => $repository['owner']['id'],
                'name' => $repository['owner']['login'],
                'url' => $repository['owner']['html_url'],
                'avatar_url' => $repository['owner']['avatar_url'],
            ],
            'issues' => [
                'total' => null,
                'open' => $repository['open_issues_count'],
                'resolved' => null
            ],
            'forks' => [
                'total' => $repository['forks'],
            ],
            'activity' => [
                'watchers_count' => $repository['watchers'],
                'subscribers_count' => $repository['subscribers_count'],
            ],
            'meta' => [
                'created_at' => $repository['created_at'],
                'updated_at' => $repository['updated_at'],
            ]
        ];
    }
}

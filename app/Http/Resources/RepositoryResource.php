<?php

namespace App\Http\Resources;

use Illuminate\Support\Arr;
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
                'id' => $repository['owner']['login'],
                'url' => $repository['owner']['html_url'],
                'avatar_url' => $repository['owner']['avatar_url'],
            ],
            'parent' => $this->when(array_key_exists('parent', $repository), function () use ($repository) {
                $parent = $repository['parent'] ?? [];
                return static::make($parent);
            }),
            'open_issues' => $repository['open_issues_count'],
            'watchers_count' => $repository['watchers'],
            'license' => optional($repository['license'])['name'] ?? null,
            'created_at' => $repository['created_at'],
            'updated_at' => $repository['updated_at'],
        ];
    }
}

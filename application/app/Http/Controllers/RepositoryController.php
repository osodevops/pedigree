<?php

namespace App\Http\Controllers;

use App\Http\Resources\RepositoryResource;

class RepositoryController
{
    /**
     * Retrieve a single repository.
     *
     * @param  string  $user
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     */
    public function show($user, $repository)
    {
        return RepositoryResource::make([
            'id' => 318624209,
            'name' => 'pedigree',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'url' => 'https://github.com/CodeLab-Team/pedigree',
            'default_branch' => 'master',
            'status' => 'active',
            'owner' => [
                'name' => 'CodeLab-Team',
                'url' => 'https://github.com/CodeLab-Team',
                'avatar_url' => 'https://avatars1.githubusercontent.com/u/75502275?v=4',
            ],
            'parent' => [
                'id' => 318624210,
                'name' => 'pedigree',
                'owner' => [
                    'name' => 'laravel',
                    'url' => 'https://github.com/laravel',
                    'avatar_url' => 'https://avatars3.githubusercontent.com/u/958072?v=4',
                ],
                'difference' => [
                    'status' => 'ahead',
                    'ahead_by' => 85,
                    'behind_by' => 18,
                    'total_commits' => 103,
                ]
            ],
            'issues' => [
                'total' => 103,
                'open' => 32,
                'resolved' => 68,
            ],
            'forks' => [
                'total' => 3,
            ],
            'activity' => [
                'watchers_count' => 103,
                'subscribers_count' => 22
            ]
        ]);
    }
}

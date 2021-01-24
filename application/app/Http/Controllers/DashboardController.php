<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Repository;
use Illuminate\Support\Arr;

class DashboardController
{
    /**
     * Render the dashboard page.
     *
     * @param  string|null  $user
     * @param  string|null  $repository
     * @return \Illuminate\Http\Response
     */
    public function show($user = null, $repository = null)
    {
        [$user, $repo] = $this->determineRepository($user, $repository);

        if ($user && ! $repo) {
            return redirect()->route('dashboard');
        }

        $repository = Repository::with('owner')
            ->where('name', $repo)
            ->where('owner_id', $user)
            ->first();

        return Inertia::render('Dashboard', [
            'repository' => $repository ?? (object) [],
            'search' => [
                'user' => $repository ? $repository->owner_id : $user,
                'repository' => $repository ? $repository->name : $repo
            ]
        ]);
    }

    /**
     * Determine the repository to use for the dashboard.
     *
     * @param  string|null  $user
     * @param  string|null  $repo
     * @return array
     */
    private function determineRepository($user, $repo)
    {
        if ($user) {
            if ($repo) {
                return [$user, $repo];
            }
        }

        return array_values(
            Arr::shuffle(config('pedigree.repos'))[0]
        );
    }
}

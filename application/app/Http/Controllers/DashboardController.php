<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Repository;

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
        if ($user && ! $repository) {
            return redirect()->route('dashboard');
        }

        $user = $user ?? config('app.default_repository.owner_id');
        $repo = $repository ?? config('app.default_repository.name');

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
}

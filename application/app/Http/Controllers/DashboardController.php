<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Repository;

class DashboardController
{
    /**
     * Render the dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user = null, $repository = null)
    {
        if ($user && ! $repository) {
            return redirect()->route('dashboard');
        }

        $repository = Repository::with('owner')
            ->where('name', $user ?? config('app.default_repository.name'))
            ->where('owner_id', $repository ?? config('app.default_repository.owner_id'))
            ->first();

        return Inertia::render('Dashboard', [
            'repository' => $repository ?? (object) [],
            'search' => [
                'user' => $repository ? $repository->owner_id : $user,
                'repository' => $repository ? $repository->name : $repository
            ]
        ]);
    }
}

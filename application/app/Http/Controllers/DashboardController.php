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
    public function show()
    {
        $repository = Repository::with('owner')
            ->where('name', config('app.default_repository.name'))
            ->where('owner_id', config('app.default_repository.owner_id'))
            ->first();

        return Inertia::render('Dashboard', [
            'repository' => $repository ?? (object) [],
        ]);
    }
}

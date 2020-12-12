<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController
{
    /**
     * Render the dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Inertia::render('Dashboard', [
            'user' => Auth::user(),
        ]);
    }
}

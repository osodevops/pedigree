<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class RossIndexController
{
    /**
     * Render the ross index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('RossIndex');
    }
}

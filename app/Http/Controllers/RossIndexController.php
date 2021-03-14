<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Repositories\RossIndex\IndexQ42020;

class RossIndexController
{
    /**
     * Render the ross index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('RossIndex', [
            'companies' => app(IndexQ42020::class),
        ]);
    }
}

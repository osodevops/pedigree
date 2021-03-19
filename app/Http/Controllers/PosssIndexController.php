<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Repositories\RossIndex\IndexQ42020;

class PosssIndexController
{
    /**
     * Render the ross index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('PossIndex', [
            'companies' => app(IndexQ42020::class),
        ]);
    }
}

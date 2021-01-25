<?php

namespace App\Http\Controllers;

use App\Models\Difference;
use App\Models\Repository;
use Illuminate\Http\Request;

class DifferenceController extends Controller
{
    /**
     * Retrieve a list of the differences from this repo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @param  string  $repository
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $username, $repository)
    {
        $baseRepository = Repository::where('owner_id', $username)
            ->where('name', $repository)
            ->firstOrFail();

        return $baseRepository->differences()
            ->with('repository')
            ->paginate($request->get('per_page', 50));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Difference;
use App\Models\Repository;
use Illuminate\Http\Request;

class DifferenceController extends Controller
{
    public function index($username, $repository)
    {
        $baseRepository = Repository::where('owner_id', $username)
            ->where('name', $repository)
            ->firstOrFail();

        return $baseRepository->differences()
            ->with('repository')
            ->paginate();
    }
}

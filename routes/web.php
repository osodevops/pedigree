<?php

use App\Http\Controllers\Statistics;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DifferenceController;
use App\Http\Controllers\PosssIndexController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\SearchRepositoryController;

$router->get('/', [DashboardController::class, 'show'])->name('dashboard');
$router->get('/poss-index', [PosssIndexController::class, 'index'])->name('ross-index');
$router->get('repos', [SearchRepositoryController::class, 'index']);
$router->get('/{user}/{repository}', [DashboardController::class, 'show'])->name('dashboard.with-data');

$router->group(['prefix' => 'repos/{user}/{repository}'], function ($router) {
    $router->get('/', [RepositoryController::class, 'show']);
    $router->get('/forks', [ForkController::class, 'index']);
    $router->get('/differences', [DifferenceController::class, 'index']);

    $router->get('/stats/commits', [Statistics\CommitController::class, 'show']);
    $router->get('/stats/languages', [Statistics\LanguageController::class, 'show'])
        ->middleware(['cache.response']);
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForkController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\Statistics;
use App\Http\Controllers\Auth\SocialiteController;

$router->view('/', 'welcome');

$router->get('auth/{provider}/redirect', [SocialiteController::class, 'index'])->name('auth.socialite.register');
$router->get('auth/{provider}/callback', [SocialiteController::class, 'show'])->name('auth.socialite.login');

Route::group(['middleware' => ['auth:sanctum']], function ($router) {
    $router->get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    $router->get('repos/{user}/{repository}', [RepositoryController::class, 'show']);
    $router->get('repos/{user}/{repository}/forks', [ForkController::class, 'index']);

    $router->get('repos/{user}/{repository}/stats/commits', [Statistics\CommitController::class, 'show'])
        ->middleware(['cache.response']);
    $router->get('repos/{user}/{repository}/stats/languages', [Statistics\LanguageController::class, 'show'])
        ->middleware(['cache.response']);
});

$router->redirect('register', '/auth/github/redirect');
$router->redirect('login', '/auth/github/redirect');

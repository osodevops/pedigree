<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\Auth\SocialiteController;

Route::view('/', 'welcome');
$router->get('auth/{provider}/redirect', [SocialiteController::class, 'index']);
$router->get('auth/{provider}/callback', [SocialiteController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function ($router) {
    $router->get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    $router->get('repos/{user}/{repository}', [RepositoryController::class, 'show']);
});

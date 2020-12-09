<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForkController;
use App\Http\Controllers\RepositoryController;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('repos/{user}/{repository}', [RepositoryController::class, 'show']);
Route::get('repos/{user}/{repository}/forks', [ForkController::class, 'index']);

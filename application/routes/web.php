<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForkController;
use App\Http\Controllers\RepositoryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);

Route::get('repos/{user}/{repository}', [RepositoryController::class, 'show']);
Route::get('repos/{user}/{repository}/forks', [ForkController::class, 'index']);

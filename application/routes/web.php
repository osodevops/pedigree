<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\Auth\SocialiteController;

Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);

Route::get('repos/{user}/{repository}', [RepositoryController::class, 'show']);

Route::get('auth/{provider}/redirect', [SocialiteController::class, 'index']);
Route::get('auth/{provider}/callback', [SocialiteController::class, 'show']);

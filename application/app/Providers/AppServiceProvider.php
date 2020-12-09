<?php

namespace App\Providers;

use App\Services\GitHub;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(GitHub::class, function () {
            return new GitHub(config('services.github.key'));
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind('App\Repositories\Dashboard\DashboardContract', 'App\Repositories\Dashboard\EloquentDashboardRepository');
    }
}

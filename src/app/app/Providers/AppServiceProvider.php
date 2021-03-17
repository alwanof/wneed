<?php

namespace App\Providers;

use App\Driver;
use App\Observers\DriverObserver;
use App\Traits\Multitenantable;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

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
        Nova::serving(function () {
            Driver::observe(DriverObserver::class);
        });

        //Driver::observe(DriverObserver::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CdnServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('\App\Helpers\Cdn', function($app) {
            return new \App\Helpers\Cdn();
        });
    }

    public function provides()
    {
        return ['App\Helpers\Cdn'];
    }
}

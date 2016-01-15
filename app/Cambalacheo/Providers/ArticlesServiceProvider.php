<?php

namespace Cambalacheo\Providers;

use Illuminate\Support\ServiceProvider;
use Cambalacheo\Services\ArticlesService;

class ArticlesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('articles', ArticlesService::class);

        $this->app->bind(
            'Cambalacheo\Repositories\ArticlesRepository',
            'Cambalacheo\Repositories\DbArticlesRepository'
        );
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'layouts.partials.sidebar_main', 'App\Http\ViewComposers\MasterCategoriesComposer'
        );

        view()->composer(
            'layouts.partials.sidebar_panel', 'App\Http\ViewComposers\PanelMenuComposer'
        );

        view()->composer(
            'layouts.partials.navigation', 'App\Http\ViewComposers\NavigationMenuComposer'
        );

        view()->composer(
            'layouts.master', 'App\Http\ViewComposers\CompleteRegistrationComposer'
        );

        // Figure it out what is the correct view
        // view()->composer('*', function($view) {
        //     print $view->getName() . "<br>";
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

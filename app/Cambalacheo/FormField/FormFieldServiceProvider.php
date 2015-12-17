<?php

namespace Cambalacheo\FormField;

use Illuminate\Support\ServiceProvider;
use Cambalacheo\FormField\FormInputBasic;

class FormFieldServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
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
        $this->app->bind('formfield', function($app) {
            $formfield = new FormField(new FormInputBasic);
            return $formfield->setSessionStore($app['session.store']);
        });

        $this->app->alias('formfield', 'Cambalacheo\FormField\FormField');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['formfield'];
    }
}

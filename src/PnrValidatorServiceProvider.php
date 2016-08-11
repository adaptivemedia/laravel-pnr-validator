<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Support\ServiceProvider;

class PnrValidatorServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->loadTranslationsFrom(
            __DIR__ . '/lang',
            'pnr-validator'
        );

        $this->app['validator']->extend('pnr', 'Adaptivemedia\PnrValidator@validatePnr');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

    }

}

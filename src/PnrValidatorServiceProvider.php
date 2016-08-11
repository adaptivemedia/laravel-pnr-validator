<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class PnrValidatorServiceProvider extends LaravelServiceProvider {

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

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Bind any implementations.
        // Whenever the validator factory is accessed in the container, we set
        // the custom resolver on it (this works in Larvel >= 5.2 as well).
        $this->app->resolving('validator', function ($factory, $app) {
            $factory->resolver(function ($translator, $data, $rules, $messages, $customAttributes = []) {
                return new PnrValidator(
                    $translator,
                    $data,
                    $rules,
                    $messages,
                    $customAttributes
                );
            });
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }
}

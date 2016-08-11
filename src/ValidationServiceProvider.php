<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ValidationServiceProvider extends LaravelServiceProvider {

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

        // Bind validator via "resolver"
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages, $customAttributes) {

            $messages['pnr'] = $translator->get('pnr-validation::validation.pnr');

            return new PnrValidator(
                $translator,
                $data,
                $rules,
                $messages,
                $customAttributes
            );
        });

        // Bind validator via "extend"
//        $messages = trans('pnr-validator::validation');
//        $this->app->bind('Adaptivemedia\PnrValidator\PnrValidator', function($app) use ($messages)
//        {
//            return new PnrValidator($app['translator'], [], [], $messages);
//        });
//
//        $translation = $this->app['translator']->trans('pnr-validator::validation.pnr');
//        $this->app['validator']->extend('pnr', 'Adaptivemedia\PnrValidator\PnrValidator@validatePnr', $translation);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

    }

}

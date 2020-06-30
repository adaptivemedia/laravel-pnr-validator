<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class PnrValidatorServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(
            __DIR__ . '/lang',
            'pnr-validator'
        );

        // Bind validator via "resolver"
        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages, $customAttributes) {

            // Set error messages
            $messages['pnr'] = $translator->get('pnr-validator::validation.pnr');

            return new PnrValidator(
                $translator,
                $data,
                $rules,
                $messages,
                $customAttributes
            );
        });
    }
}

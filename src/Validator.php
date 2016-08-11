<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Validation\Validator as LaravelValidator;

class Validator extends LaravelValidator
{

    /**
     * Usage: pnr
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return boolean
     */
    public function validatePnr($attribute, $value, $parameters)
    {
        return PnrChecker::check($value);
    }
}
<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Validation\Validator;

class PnrValidator extends Validator
{
    /**
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return boolean
     */
    public function validatePnr($attribute, $value, $parameters)
    {
        return Checker::check($value);
    }
}
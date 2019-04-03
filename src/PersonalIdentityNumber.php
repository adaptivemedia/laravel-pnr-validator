<?php

namespace Adaptivemedia\PnrValidator;

use Illuminate\Contracts\Validation\Rule;

class PersonalIdentityNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return PnrChecker::check($value);
    }

    public function message(): string
    {
        return __('pnr-validator::validation.pnr');
    }
}

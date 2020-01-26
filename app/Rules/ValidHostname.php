<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use function dns_check_record;
use function filter_var;
use function is_numeric;
use function preg_match;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_IP;

class ValidHostname implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_IP) !== false) {
            return true;
        }

        if (filter_var($value, FILTER_VALIDATE_DOMAIN) !== false && dns_check_record($value, 'A')) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid IP or URL (hostname).';
    }
}

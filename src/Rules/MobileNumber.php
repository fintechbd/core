<?php

namespace Fintech\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MobileNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $matches = [];

        preg_match('/^\+[1-9]\d{9,14}$/i', $value, $matches);

        if (empty($matches)) {
            $fail('The :attribute is not a valid E164 mobile number value e.g +8801234567891.');
        }
    }
}

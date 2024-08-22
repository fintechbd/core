<?php

namespace Fintech\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PercentNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $matches = [];

        preg_match('/^(-?\d+(%|.)?\d*%?)$/i', $value, $matches);

        if (empty($matches)) {
            $fail('The :attribute is not a valid percentage or numeric value Eg:0.5,-10.45%.');
        }
    }
}

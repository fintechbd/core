<?php

namespace Fintech\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Base64File implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $matches = [];

        preg_match('/^data:([a-z0-9]+\/[a-z0-9\+]+);base64,/i', $value, $matches);

        if (empty($matches)) {
            $fail('The :attribute is not a valid Base64 file content.');
        }
    }
}

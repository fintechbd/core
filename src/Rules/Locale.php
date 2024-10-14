<?php

namespace Fintech\Core\Rules;

use Closure;
use Fintech\MetaData\Facades\MetaData;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Locale implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $available = MetaData::language()->list(['enabled' => true])->pluck('language.code')->unique()->toArray();

        if (!empty(array_diff(array_keys($value), $available))) {
            $fail("The request locales do not match. Available locales: [" . implode(', ', $available).'].');
        }
    }
}

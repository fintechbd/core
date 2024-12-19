<?php

namespace Fintech\Core\Rules;

use Fintech\Core\Facades\Core;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\PotentiallyTranslatedString;

class MasterCurrency implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $masterExists = Cache::remember("master-user-country-[{$value}]", HOUR, function () use ($value) {
            if (Core::packageExists('Auth')) {
                return (bool)\Fintech\Auth\Facades\Auth::user()->findWhere([
                    'role_name' => \Fintech\Core\Enums\Auth\SystemRole::MasterUser->value,
                    'country_id' => $value
                ]);
            }
            return false;
        });

        if (!$masterExists) {
            $fail('core::validation.master_currency');
        }
    }
}

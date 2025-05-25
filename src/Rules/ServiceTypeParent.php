<?php

namespace Fintech\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ServiceTypeParent implements ValidationRule
{
    /**
     * @param string $type
     */
    public function __construct(private string $type = 'yes')
    {

    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if ($value != null) {
            $serviceType = business()->serviceType()->find($value);
            if ($serviceType->service_type_is_parent != $this->type) {
                $fail("The parent service type {$serviceType->service_type_name} needs to be set ({$this->type}).");
            }
        }
    }
}

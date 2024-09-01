<?php

namespace Fintech\Core\Rules;

use Closure;
use Fintech\Business\Facades\Business;
use Illuminate\Contracts\Validation\ValidationRule;

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
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if ($value != null) {
            $serviceType = Business::serviceType()->find($value);
            if ($serviceType->service_type_is_parent != $this->type) {
                $fail("The parent service type {$serviceType->service_type_name} needs to be set ({$this->type}).");
            }
        }
    }
}

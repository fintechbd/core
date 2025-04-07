<?php

namespace Fintech\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ArrayOfRule implements ValidationRule
{
    private array $allowedTypes;

    public function __construct(...$types)
    {
        $this->allowedTypes = $types;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_array($value)) {
            foreach ($value as $item) {
                if (!in_array(gettype($item), $this->allowedTypes)) {
                    $fail('The :attribute item is not a valid data type of ['.json_encode($this->allowedTypes).'].');
                }
            }
        } else {
            if (!in_array(gettype($value), $this->allowedTypes)) {
                $fail('The :attribute item is not a valid data type of ['.json_encode($this->allowedTypes).'].');
            }
        }
    }
}

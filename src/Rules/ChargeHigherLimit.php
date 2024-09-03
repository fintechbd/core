<?php

namespace Fintech\Core\Rules;

use Closure;
use Fintech\Business\Facades\Business;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class ChargeHigherLimit implements DataAwareRule, ValidationRule
{
    /**
     * All the data under validation.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];

    /**
     * Set the data under validation.
     *
     * @param array<string, mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        logger("log", [$this->data]);

        if (!Business::chargeBreakDown()->available($this->data['service_stat_id'], $this->data['lower_limit'], $this->data['higher_limit'])) {
            $fail("The higher limit isn't allowed.");
        }
    }
}

<?php

namespace Fintech\Core\Rules;

use Closure;
use Fintech\Business\Facades\Business;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class ChargeLowerLimit implements DataAwareRule, ValidationRule
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
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $limits = Business::chargeBreakDown()->list([
            'service_stat_id' => $this->data['service_stat_id'],
            'sort' => 'lower_limit',
            'dir' => 'asc',
            'paginate' => false
        ]);

        if ($limits->isNotEmpty()) {
            $lowestLimit = $limits->first()->lower_limit;
            $highestLimit = $limits->last()->higher_limit;

            if ()
        }
    }
}

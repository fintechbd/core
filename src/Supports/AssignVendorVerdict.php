<?php

namespace Fintech\Core\Supports;

use Fintech\Core\Abstracts\DynamicProperty;

/**
 * @property string $ref_number vendor provided a unique reference number
 * @property float $amount the total amount the vendor deposited or deducted
 * @property float $charge if that amount includes additional charge
 * @property float $discount if that amount includes additional discount
 * @property float $commission if that amount includes additional commission
 * @property array $timeline order timeline entry
 *
 * @method self ref_number(string $ref_number = '')
 * @method self amount(float|int $amount = 0)
 * @method self charge(float|int $charge = 0)
 * @method self discount(float|int $discount = 0)
 * @method self commission(float|int $commission = 0)
 * @method self timeline(array $messages = [])
 */
class AssignVendorVerdict extends DynamicProperty
{
    protected array $fillable = ['status', 'message', 'ref_number', 'original', 'amount', 'charge', 'discount', 'commission', 'timeline'];

    protected array $casts = [
        'status' => 'bool',
        'message' => 'string',
        'ref_number' => 'string',
        'amount' => 'float',
        'charge' => 'float',
        'discount' => 'float',
        'commission' => 'float',
        'timeline' => 'array'
    ];

    protected array $defaults = [
        'status' => false,
        'message' => '',
        'ref_number' => '',
        'original' => null,
        'amount' => 0,
        'charge' => 0,
        'discount' => 0,
        'commission' => 0,
        'timeline' => [
            'message' => '',
            'flag' => 'info',
            'timestamp' => null
        ]
    ];

    public function orderTimeline(string $message, string $flag = 'info'): static
    {
        $this->attributes['timeline']['message'] = $message;
        $this->attributes['timeline']['flag'] = $flag;
        $this->attributes['timeline']['timestamp'] = now();

        return $this;
    }

}

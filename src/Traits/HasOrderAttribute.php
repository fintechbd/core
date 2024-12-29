<?php

namespace Fintech\Core\Traits;

use BackedEnum;
use Fintech\Core\Enums\RequestPlatform;
use Fintech\Core\Enums\Transaction\OrderType;

/**
 * @property-read OrderType $orderType
 * @property-read RequestPlatform $requestPlatform
 */
trait HasOrderAttribute
{
    public function getOrderAttribute(): ?OrderType
    {
        return OrderType::tryFrom($this->order_data['order_type']);
    }

    public function getRequestPlatformAttribute(): ?RequestPlatform
    {
        return RequestPlatform::tryFrom($this->order_data['request_form']);
    }
}

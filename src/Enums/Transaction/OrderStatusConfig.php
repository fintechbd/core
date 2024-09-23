<?php

namespace Fintech\Core\Enums\Transaction;

use Fintech\Core\Traits\EnumHasSerialization;

enum OrderStatusConfig: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case Purchased = 'purchase';
    case Accepted = 'accept';
    case Rejected = 'reject';
    case Cancelled = 'cancel';
}

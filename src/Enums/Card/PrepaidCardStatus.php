<?php

namespace Fintech\Core\Enums\Card;

use Fintech\Core\Traits\EnumHasSerialization;

enum PrepaidCardStatus: string
{
    use EnumHasSerialization;

    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Declined = 'declined';
    case Accepted = 'accepted';
    case Active = 'active';
    case Suspended = 'suspended';
    case Lost = 'lost';
    case Stolen = 'stolen';
    case Closed = 'closed';
}

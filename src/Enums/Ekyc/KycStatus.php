<?php

namespace Fintech\Core\Enums\Ekyc;

use Fintech\Core\Traits\EnumHasSerialization;

enum KycStatus: string
{
    use EnumHasSerialization;

    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Accepted = 'accepted';
    case Declined = 'declined';

}

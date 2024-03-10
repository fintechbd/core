<?php

namespace Fintech\Core\Enums\Ekyc;

use Fintech\Core\Traits\HasSerialization;

enum KycStatus: string
{
    use HasSerialization;

    case Received = 'received';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Accepted = 'accepted';
    case Declined = 'declined';

}

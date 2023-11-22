<?php

namespace Fintech\Core\Enums\Reload;

use Fintech\Core\Traits\HasSerialization;

/**
 * N.B: status value must have to match with order status
 */
enum DepositStatus: string
{
    use HasSerialization;
    case Processing = 'processing';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';

}

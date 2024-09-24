<?php

namespace Fintech\Core\Enums\Reload;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

/**
 * N.B: status value must have to match with order status
 */
enum DepositStatus: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Purple600, label: 'Previewing')]
    case Processing = 'processing';

    #[Enumeration(color: Color::Sky400, description: 'The deposit request has been processed.')]
    case Accepted = 'accepted';

    #[Enumeration(color: Color::Red600)]
    case Rejected = 'rejected';

    #[Enumeration(color: Color::Yellow600)]
    case Cancelled = 'cancelled';


}

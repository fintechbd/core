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

    #[Enumeration(color: Color::Purple600)]
    case Processing = 'processing';

    #[Enumeration(color: Color::Green400)]
    case Accepted = 'accepted';

    #[Enumeration(color: Color::Red600)]
    case Rejected = 'rejected';

    #[Enumeration(color: Color::Slate400)]
    case Cancelled = 'cancelled';
    #[Enumeration(color: Color::Yellow400)]
    case AdminVerification = 'admin_verification';


}

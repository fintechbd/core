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

    #[Enumeration(color: Color::Purple500)]
    case Processing = 'processing';

    #[Enumeration(color: Color::Green500)]
    case Accepted = 'accepted';

    #[Enumeration(color: Color::Red500)]
    case Rejected = 'rejected';

    #[Enumeration(color: Color::Slate500)]
    case Cancelled = 'cancelled';
    #[Enumeration(color: Color::Yellow500, label: 'Verification')]
    case AdminVerification = 'admin_verification';


}

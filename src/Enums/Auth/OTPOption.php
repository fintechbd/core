<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum OTPOption: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case Link = 'link';
    case Otp = 'otp';
}

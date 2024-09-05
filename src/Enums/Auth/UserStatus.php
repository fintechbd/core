<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum UserStatus: string
{
    use EnumHasSerialization;

    case Registered = 'REGISTERED';
    case Onboarded = 'ONBOARDED';
    case Suspended = 'SUSPENDED';
    case Flagged = 'FLAGGED';
    case Terminated = 'TERMINATED';

}

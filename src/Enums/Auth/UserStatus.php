<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum UserStatus: string
{
    use HasSerialization;
    case
    Registered = 'REGISTERED';
    case
    Onboarded = 'ONBOARDED';
    case
    Suspended = 'SUSPENDED';
    case
    Flagged = 'FLAGGED';
    case
    Terminated = 'TERMINATED';

}

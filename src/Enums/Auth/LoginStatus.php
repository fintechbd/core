<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum LoginStatus: string
{
    use EnumHasSerialization;

    case
    Invalid = 'invalid';
    case
    Failed = 'failed';
    case
    Successful = 'successful';
    case
    Banned = 'banned';
}

<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum FavouriteStatus: string
{
    use EnumHasSerialization;

    case
    Requested = 'REQUESTED';
    case
    Accepted = 'ACCEPTED';
    case
    Rejected = 'REJECTED';
    case
    Blocked = 'BLOCKED';
}

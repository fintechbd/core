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
    //cannot request money but sending is available
    case
    Blocked = 'BLOCKED';

}

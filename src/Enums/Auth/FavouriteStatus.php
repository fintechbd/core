<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum FavouriteStatus: string
{
    use HasSerialization;

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

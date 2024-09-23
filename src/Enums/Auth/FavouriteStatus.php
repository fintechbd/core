<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum FavouriteStatus: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: 'primary', description: 'Favourite request has been sent.')]
    case Requested = 'requested';
    #[Enumeration(color: 'success', description: 'Favourite request has been accepted.')]
    case Accepted = 'accepted';
    #[Enumeration(color: 'danger', description: 'Favourite request has been declined.')]
    case Rejected = 'rejected';
    #[Enumeration(color: 'secondary', description: 'Favourite request has blocked the user.')]
    case Blocked = 'blocked';

}

<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum FavouriteStatus: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Yellow500, description: 'Favourite request has been sent.')]
    case Requested = 'requested';

    #[Enumeration(color: Color::Green500, description: 'Favourite request has been accepted.')]
    case Accepted = 'accepted';

    #[Enumeration(color: Color::Red500, description: 'Favourite request has been declined.')]
    case Rejected = 'rejected';
    #[Enumeration(color: Color::Gray500, description: 'Favourite request has blocked the user.')]
    case Blocked = 'blocked';

}

<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum RequestDirection: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Green500, label: '⇓ IN')]
    case InBound = 'inbound';
    #[Enumeration(color: Color::Red500, label: '⇑ OUT')]
    case OutBound = 'outbound';
}

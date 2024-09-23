<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Traits\EnumHasSerialization;

enum RequestDirection: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case InBound = 'inbound';
    case OutBound = 'outbound';
}

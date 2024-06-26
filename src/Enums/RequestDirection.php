<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Traits\EnumHasSerialization;

enum RequestDirection: string
{
    use EnumHasSerialization;
    case InBound = 'inbound';
    case OutBound = 'outbound';
}

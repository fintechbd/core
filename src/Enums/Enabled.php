<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Traits\EnumHasSerialization;

enum Enabled: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case Yes = 'yes';
    case No = 'no';
}

<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Traits\EnumHasSerialization;

enum Enabled: string
{
    use EnumHasSerialization;

    case Yes = 'yes';
    case No = 'no';
}

<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum RiskProfile: string
{
    use EnumHasSerialization;

    case Low = 'green';
    case Moderate = 'yellow';
    case High = 'red';
}

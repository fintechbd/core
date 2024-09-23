<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum RiskProfile: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case Low = 'green';
    case Moderate = 'yellow';
    case High = 'red';
}

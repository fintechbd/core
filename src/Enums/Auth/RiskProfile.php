<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum RiskProfile: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Green400)]
    case Low = 'green';
    #[Enumeration(color: Color::Yellow600)]
    case Moderate = 'yellow';
    #[Enumeration(color: Color::Red600)]
    case High = 'red';
}

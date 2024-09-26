<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum LoginStatus: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Orange500)]
    case Invalid = 'invalid';
    #[Enumeration(color: Color::Red500)]
    case Failed = 'failed';
    #[Enumeration(color: Color::Green500)]
    case Successful = 'successful';
    #[Enumeration(color: Color::Teal500)]
    case Banned = 'banned';
}

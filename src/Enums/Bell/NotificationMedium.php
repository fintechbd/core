<?php

namespace Fintech\Core\Enums\Bell;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum NotificationMedium: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Zinc500)]
    case Sms = 'sms';
    #[Enumeration(color: Color::Teal500)]
    case Email = 'email';
    #[Enumeration(color: Color::Green500)]
    case Push = 'push';
    #[Enumeration(color: Color::Sky500)]
    case Chat = 'chat';
}

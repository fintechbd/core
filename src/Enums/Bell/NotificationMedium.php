<?php

namespace Fintech\Core\Enums\Bell;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum NotificationMedium: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Red500, label: 'SMS')]
    case Sms = 'sms';
    #[Enumeration(color: Color::Teal500)]
    case Email = 'mail';
    #[Enumeration(color: Color::Blue500, label: 'Push')]
    case Push = 'push';
    #[Enumeration(color: Color::Amber500, label: 'Message')]
    case Chat = 'chat';
}

<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum RequestPlatform: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Sky500, label: 'Website')]
    case WebCustomer = 'web-customer';
    #[Enumeration(color: Color::Stone500, label: 'Desktop')]
    case DesktopCustomer = 'desktop-customer';
    #[Enumeration(color: Color::Amber500, label: 'Android')]
    case AndroidCustomer = 'android-customer';
    #[Enumeration(color: Color::Cyan500, label: 'iOS')]
    case IosCustomer = 'ios-customer';
    #[Enumeration(color: Color::Orange500, label: 'Agent')]
    case WebAgent = 'web-agent';
    #[Enumeration(color: Color::Yellow500, label: 'Admin')]
    case WebAdmin = 'web-admin';
}

<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum RequestPlatform: string implements \JsonSerializable
{
    use EnumHasSerialization;
    #[Enumeration(color: 'primary', label: 'Website')]
    case WebCustomer = 'web-customer';
    #[Enumeration(color: 'primary', label: 'Desktop')]
    case DesktopCustomer = 'desktop-customer';
    #[Enumeration(color: 'primary', label: 'Android')]
    case AndroidCustomer = 'android-customer';
    #[Enumeration(color: 'primary', label: 'iOS')]
    case IosCustomer = 'ios-customer';
    #[Enumeration(color: 'warning', label: 'Agent')]
    case WebAgent = 'web-agent';
    #[Enumeration(color: 'danger', label: 'Admin')]
    case WebAdmin = 'web-admin';
}

<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum RequestPlatform: string implements \JsonSerializable
{
    use EnumHasSerialization;
    #[Enumeration(color: 'primary', hex: '#0d6efdff')]
    case WebCustomer = 'web-customer';
    #[Enumeration(color: 'primary', hex: '#0d6efdff')]
    case DesktopCustomer = 'desktop-customer';
    #[Enumeration(color: 'primary', hex: '#0d6efdff')]
    case AndroidCustomer = 'android-customer';
    #[Enumeration(color: 'primary', hex: '#0d6efdff', label: 'iOS Customer')]
    case IosCustomer = 'ios-customer';
    #[Enumeration(color: 'warning', hex: '#0d6efdff', label: 'Agent')]
    case WebAgent = 'web-agent';
    #[Enumeration(color: 'danger', hex: '#dc3545ff', label: 'Administrator')]
    case WebAdmin = 'web-admin';
}

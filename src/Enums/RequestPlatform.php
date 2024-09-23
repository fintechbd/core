<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Traits\EnumHasSerialization;

enum RequestPlatform: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case WebCustomer = 'web-customer';
    case DesktopCustomer = 'desktop-customer';
    case AndroidCustomer = 'android-customer';
    case IosCustomer = 'ios-customer';
    case WebAgent = 'web-agent';
    case WebAdmin = 'web-admin';
}

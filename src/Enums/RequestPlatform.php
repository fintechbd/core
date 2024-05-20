<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Traits\EnumHasSerialization;

enum RequestPlatform: string
{
    use EnumHasSerialization;

    case Customer = 'web-customer';
    case Agent = 'web-agent';
    case Admin = 'web-admin';
}

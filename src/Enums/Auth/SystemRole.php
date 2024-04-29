<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum SystemRole: string
{
    use EnumHasSerialization;

    case SuperAdmin = 'Super Admin';
    case MasterUser = 'Master User';

}

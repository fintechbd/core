<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum SystemRole: string
{
    use HasSerialization;

    case SuperAdmin = 'Super Admin';
    case MasterUser = 'Master User';

}

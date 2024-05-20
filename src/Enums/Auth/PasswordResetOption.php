<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum PasswordResetOption: string
{
    use EnumHasSerialization;
    case
    TemporaryPassword = 'temporary_password';
    case
    ResetLink = 'reset_link';
    case
    Otp = 'otp';
}

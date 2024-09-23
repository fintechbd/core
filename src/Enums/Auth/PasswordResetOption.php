<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\EnumHasSerialization;

enum PasswordResetOption: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case TemporaryPassword = 'temporary_password';
    case ResetLink = 'reset_link';
    case Otp = 'otp';
}

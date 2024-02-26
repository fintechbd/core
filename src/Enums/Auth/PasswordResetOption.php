<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum PasswordResetOption: string
{
    use HasSerialization;

    case
    TemporaryPassword = 'temporary_password';
    case
    ResetLink = 'reset_link';
    case
    Otp = 'otp';
}

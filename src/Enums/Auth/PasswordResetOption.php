<?php

namespace Fintech\Core\Enums\Auth;

enum PasswordResetOption: string
{
    case
    TemporaryPassword = 'temporary_password';
    case
    ResetLink = 'reset_link';
    case
    Otp = 'otp';
}

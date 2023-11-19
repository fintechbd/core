<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum OTPOption: string
{
    use HasSerialization;

    case
    Link = 'link';
    case
    Otp = 'otp';
}

<?php

namespace Fintech\Core\Enums\Auth;

enum OTPOption: string
{
    case
    Link = 'link';
    case
    Otp = 'otp';
}

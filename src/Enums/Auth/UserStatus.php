<?php

namespace Fintech\Core\Enums\Auth;

enum UserStatus: string
{
    case
    Active = 'ACTIVE';
    case
    InActive = 'INACTIVE';
    case
    Banned = 'BANNED';
    case
    Flagged = 'FLAGGED';
    case
    Terminated = 'TERMINATED';
}

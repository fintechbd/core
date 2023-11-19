<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum RiskProfile: string
{
    use HasSerialization;

    case
    Low = 'green';
    case
    Moderate = 'yellow';
    case
    High = 'red';
}

<?php

namespace Fintech\Core\Enums\Auth;

enum RiskProfile: string
{
    case
    Low = 'green';
    case
    Moderate = 'yellow';
    case
    High = 'red';
}

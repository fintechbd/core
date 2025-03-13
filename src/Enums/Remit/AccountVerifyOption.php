<?php

namespace Fintech\Core\Enums\Remit;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum AccountVerifyOption: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Yellow500)]
    case BankTransfer = 'bank_transfer';

    #[Enumeration(color: Color::Purple500)]
    case Wallet = 'wallet';

    #[Enumeration(color: Color::Blue500)]
    case CashPickup = 'cash_pickup';
}

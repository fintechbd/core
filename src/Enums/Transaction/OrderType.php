<?php

namespace Fintech\Core\Enums\Transaction;

enum OrderType: string implements \JsonSerializable
{
    case BankDeposit = 'bank_deposit';
    case CardDeposit = 'card_deposit';
    case InteracDeposit = 'interac_e_transfer';
    case BankTransfer = 'bank_transfer';
    case CashPickup = 'cash_pickup';
    case WalletTransfer = 'wallet_transfer';

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}

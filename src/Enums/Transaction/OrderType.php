<?php

namespace Fintech\Core\Enums\Transaction;

use Fintech\Core\Traits\EnumHasSerialization;

enum OrderType: string implements \JsonSerializable
{
    use EnumHasSerialization;

    case BankDeposit = 'bank_deposit';
    case CardDeposit = 'card_deposit';
    case InteracDeposit = 'interac_e_transfer';
    case BankTransfer = 'bank_transfer';
    case CashPickup = 'cash_pickup';
    case WalletTransfer = 'wallet_transfer';
    case Airtime = 'airtime';
    case BillPayment = 'bill_payment';
    case WalletToWallet = 'wallet_to_wallet';
    case CurrencySwap = 'currency_swap';
    case RequestMoney = 'request_money';
    case WalletToPrepaidCard = 'wallet_to_prepaid_card';
    const WalletToBank = 'wallet_to_bank';
    const WalletToAtm = 'wallet_to_atm';

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}

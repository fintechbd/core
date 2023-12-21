<?php

namespace Fintech\Core\Enums\Auth;

use Fintech\Core\Traits\HasSerialization;

enum ProofOfAddressType:string
{
    use HasSerialization;

    case
    TenancyContract = 'tenancy_contract';
    case
    UtilityBill = 'utility_bill';
    case
    BankStatement = 'bank_statement';
    case
    CreditCardStatement = 'credit_card_statement';
    case
    TelephoneBill = 'telephone_bill';
}

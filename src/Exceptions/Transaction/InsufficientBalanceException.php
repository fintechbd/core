<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;

/**
 * Class InsufficientBalanceException
 */
class InsufficientBalanceException extends Exception
{
    public function __construct(string $currency)
    {
        $message = __('core::messages.transaction.insufficient_balance', ['currency' => $currency]);

        parent::__construct($message, 0, null);
    }
}

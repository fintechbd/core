<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;

/**
 * Class RequestOrderExistsException
 */
class RequestOrderExistsException extends Exception
{
    public function __construct()
    {
        $transaction_delay = config('fintech.transaction.delay_time', 10);

        $message = __('core::messages.transaction.request_order_already_exists',[
            'delay' => $transaction_delay,
            'next_available' => now()->addMinutes($transaction_delay)->format('h:i A e')
        ]);

        parent::__construct($message, 0, null);
    }
}

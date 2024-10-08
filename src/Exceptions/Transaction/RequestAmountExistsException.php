<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;

/**
 * Class RequestAmountExistsException
 */
class RequestAmountExistsException extends Exception
{
    public function __construct()
    {
        $message = __('core::messages.transaction.request_amount_already_exists');

        parent::__construct($message, 0, null);
    }
}

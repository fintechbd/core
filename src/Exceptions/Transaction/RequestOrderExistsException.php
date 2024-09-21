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
        $message = __('core::messages.transaction.request_order_already_exists');

        parent::__construct($message, 0, null);
    }
}

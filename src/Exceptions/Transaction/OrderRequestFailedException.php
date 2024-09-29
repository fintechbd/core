<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;

/**
 * Class RequestOrderExistsException
 */
class OrderRequestFailedException extends Exception
{
    public function __construct(string $service, int $code = 0, Exception $previous = null)
    {
        $service = ucwords(strtolower(str_replace(['_'], ' ',$service)));

        $message = __('core::messages.transaction.request_failed', ['service' => $service]);

        parent::__construct($message, $code, $previous);
    }
}

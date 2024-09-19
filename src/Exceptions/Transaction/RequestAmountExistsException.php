<?php

namespace Fintech\Core\Exceptions\Transaction;

use Exception;
use Fintech\MetaData\Facades\MetaData;
use Throwable;

/**
 * Class RequestAmountExistsException
 */
class RequestAmountExistsException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = $message ?? __('core::messages.transaction.request_amount_already_exists');

        parent::__construct($message, $code, $previous);
    }
}

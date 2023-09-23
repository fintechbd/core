<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Throwable;

/**
 * Class StoreOperationException
 * @package Fintech\Core\Exceptions
 */
class StoreOperationException extends Exception
{
    /**
     * StoreOperationException constructor.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = 'Item create failed';
        }

        parent::__construct($message, $code, $previous);
    }
}

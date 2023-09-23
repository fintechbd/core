<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Throwable;

/**
 * Class RestoreOperationException
 * @package Fintech\Core\Exceptions
 */
class RestoreOperationException extends Exception
{
    /**
     * RestoreOperationException constructor.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = 'Item restore failed';
        }

        parent::__construct($message, $code, $previous);
    }
}

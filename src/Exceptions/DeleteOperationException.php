<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Throwable;

/**
 * Class DeleteOperationException
 * @package Fintech\Core\Exceptions
 */
class DeleteOperationException extends Exception
{
    /**
     * DeleteOperationException constructor.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = 'Item not found';
        }
        parent::__construct($message, $code, $previous);
    }
}

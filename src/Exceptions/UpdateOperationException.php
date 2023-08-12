<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Throwable;

/**
 * Class UpdateOperationException
 * @package Fintech\Core\Exceptions
 */
class UpdateOperationException extends Exception
{
    /**
     * UpdateOperationException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = "Item update failed";
        }

        parent::__construct($message, $code, $previous);
    }
}

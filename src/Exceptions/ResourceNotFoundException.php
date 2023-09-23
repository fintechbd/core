<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Throwable;

/**
 * Class ResourceNotFoundException
 * @package Fintech\Core\Exceptions
 */
class ResourceNotFoundException extends Exception
{
    /**
     * ResourceNotFoundException constructor.
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

<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Fintech\Core\Traits\ModelExceptionTrait;
use Throwable;

/**
 * Class ModelOperationException
 * @package Fintech\Core\Exceptions
 */
class ModelOperationException extends Exception
{
    use ModelExceptionTrait;

    /**
     * ModelOperationException constructor.
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

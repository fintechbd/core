<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Fintech\Core\Traits\ModelExceptionTrait;
use Throwable;

/**
 * Class StoreOperationException
 * @package Fintech\Core\Exceptions
 */
class StoreOperationException extends Exception
{
    use ModelExceptionTrait;

    /**
     * StoreOperationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = __('core::messages.exception.store', ['model' => $this->getModel()]);
        }

        parent::__construct($message, $code, $previous);
    }
}

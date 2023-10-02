<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Fintech\Core\Traits\ModelExceptionTrait;
use Throwable;

/**
 * Class DeleteOperationException
 * @package Fintech\Core\Exceptions
 */
class DeleteOperationException extends Exception
{
    use ModelExceptionTrait;

    /**
     * DeleteOperationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = __('core::messages.exception.delete', ['model' => $this->getModel(), 'id' => $this->getId()]);
        }

        parent::__construct($message, $code, $previous);
    }
}

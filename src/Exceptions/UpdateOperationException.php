<?php

namespace Fintech\Core\Exceptions;

use Exception;
use Fintech\Core\Traits\ModelExceptionTrait;
use Throwable;

/**
 * Class UpdateOperationException
 * @package Fintech\Core\Exceptions
 */
class UpdateOperationException extends Exception
{
    use ModelExceptionTrait;

    protected $type = 'update';

    /**
     * UpdateOperationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (strlen($message) == 0) {
            $message = __('core::messages.exception.update', ['model' => $this->getModel(), 'id' => $this->getId()]);
        }

        parent::__construct($message, $code, $previous);
    }
}

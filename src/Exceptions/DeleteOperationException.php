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

    protected $type = 'delete';

    //__('core::messages.exception.delete', ['model' => $this->getModel(), 'id' => $this->getId()])
}

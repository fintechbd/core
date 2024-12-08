<?php

namespace Fintech\Core\Exceptions;

use Exception;

/**
 * Class RelationReturnMissingException
 */
class RelationReturnMissingException extends Exception
{
    public function setModel(string $model, string $method)
    {
        $this->message = __('core::messages.exception.relation_missing', ['model' => $model, 'method' => $method]);

        return $this;
    }
}

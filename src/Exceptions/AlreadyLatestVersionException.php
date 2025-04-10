<?php

namespace Fintech\Core\Exceptions;

use Exception;

/**
 * Class DeleteOperationException
 */
class AlreadyLatestVersionException extends Exception
{
    public function __construct(string $version = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = "Application version(<fg=bright-yellow;options=bold>{$version}</>) is already latest";

        parent::__construct($message, $code, $previous);
    }
}

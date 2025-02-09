<?php

namespace Fintech\Core\Exceptions;

use Exception;

/**
 * Class PackageNotInstalledException
 */
class PackageNotInstalledException extends Exception
{
    public function __construct(string $package = 'Core')
    {
        $message = __('core::messages.package_not_installed', ['module' => $package]);

        parent::__construct($message, 0, null);
    }
}

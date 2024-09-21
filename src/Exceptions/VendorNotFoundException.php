<?php

namespace Fintech\Core\Exceptions;

use Exception;

/**
 * Class VendorNotFoundException
 */
class VendorNotFoundException extends Exception
{
    public function __construct(string $vendor = 'Vendor')
    {
        $message = __('core::messages.assign_vendor.not_found', ['slug' => $vendor]);

        parent::__construct($message, 0, null);
    }
}

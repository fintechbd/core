<?php

namespace Fintech\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fintech\Core\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Core\Core::class;
    }
}

<?php

namespace Fintech\Core\Facades;

use Fintech\Core\Services\SettingService;
use Illuminate\Support\Facades\Facade;

/**
 * Class Core
 * @method static SettingService setting()
 * @method static bool packageExists(string $name)
 * @see \Fintech\Core\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Core\Core::class;
    }
}

<?php

namespace Fintech\Core\Facades;

use Fintech\Core\Services\SettingService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SettingService setting()
 * @method static bool packageExists(string $name)
 * @method static \Fintech\Core\Services\ApiLogService apiLog()
 * @method static \Fintech\Core\Services\FailedJobService failedJob()
 * // Crud Service Method Point Do not Remove //
 *
 * @see \Fintech\Core\Core
 */
class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Core\Core::class;
    }
}

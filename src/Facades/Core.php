<?php

namespace Fintech\Core\Facades;

use Fintech\Core\Services\ApiLogService;
use Fintech\Core\Services\FailedJobService;
use Fintech\Core\Services\SettingService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SettingService setting()
 * @method static bool packageExists(string $name)
 * @method static ApiLogService apiLog()
 * @method static FailedJobService failedJob()
 * @method static \Fintech\Core\Services\ScheduleService schedule()
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

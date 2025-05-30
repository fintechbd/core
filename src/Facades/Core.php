<?php

namespace Fintech\Core\Facades;

use Fintech\Core\Services\ApiLogService;
use Fintech\Core\Services\FailedJobService;
use Fintech\Core\Services\ScheduleService;
use Fintech\Core\Services\SettingService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Collection|SettingService setting(array $filters = null)
 * @method static bool packageExists(string $name, bool $throw = false)
 * @method static \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Collection|ApiLogService apiLog(array $filters = null)
 * @method static \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Collection|FailedJobService failedJob(array $filters = null)
 * @method static \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Collection|ScheduleService schedule(array $filters = null)
 * @method static \Fintech\Core\Services\TranslationService translation()
 * @method static \Fintech\Core\Services\JobBatchService jobBatch()
 * @method static \Fintech\Core\Services\ClientErrorService clientError()
 * @method static \Fintech\Core\Services\MailService mail()
 * @method static \Fintech\Core\Core|mixed launch(string $name = 'core')
 * @method static \Fintech\Core\Services\MigrationService migration()
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

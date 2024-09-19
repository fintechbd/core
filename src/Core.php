<?php

namespace Fintech\Core;

use Fintech\Core\Services\ApiLogService;
use Fintech\Core\Services\FailedJobService;
use Fintech\Core\Services\JobService;
use Fintech\Core\Services\ScheduleService;
use Fintech\Core\Services\SettingService;

class Core
{
    /**
     * @return SettingService
     */
    public function setting($filters = null)
{
	return \singleton(SettingService::class, $filters);
    }

    /**
     * @return ApiLogService
     */
    public function apiLog($filters = null)
{
	return \singleton(ApiLogService::class, $filters);
    }

    /**
     * @return FailedJobService
     */
    public function failedJob($filters = null)
{
	return \singleton(FailedJobService::class, $filters);
    }

    /**
     * @return JobService
     */
    public function job($filters = null)
{
	return \singleton(JobService::class, $filters);
    }

    /**
     * @return ScheduleService
     */
    public function schedule($filters = null)
{
	return \singleton(ScheduleService::class, $filters);
    }

    //** Crud Service Method Point Do not Remove **//


    /**
     * verify if a available addon or package is installed
     *
     * @param string $name
     * @return bool
     */
    public function packageExists(string $name): bool
    {
        return class_exists("\Fintech\\{$name}\Facades\\{$name}");
    }
}

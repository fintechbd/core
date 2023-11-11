<?php

namespace Fintech\Core;

use Fintech\Core\Services\JobService;
use Fintech\Core\Services\SettingService;

class Core
{
    /**
     * @return SettingService
     */
    public function setting()
    {
        return app(SettingService::class);
    }

    /**
     * @return \Fintech\Core\Services\ApiLogService
     */
    public function apiLog()
    {
        return app(\Fintech\Core\Services\ApiLogService::class);
    }

    /**
     * @return \Fintech\Core\Services\FailedJobService
     */
    public function failedJob()
    {
        return app(\Fintech\Core\Services\FailedJobService::class);
    }

    /**
     * @return JobService
     */
    public function job()
    {
        return app(JobService::class);
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

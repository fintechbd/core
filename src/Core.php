<?php

namespace Fintech\Core;

use Fintech\Core\Exceptions\PackageNotInstalledException;
use Fintech\Core\Services\ApiLogService;
use Fintech\Core\Services\FailedJobService;
use Fintech\Core\Services\JobService;
use Fintech\Core\Services\ScheduleService;
use Fintech\Core\Services\SettingService;
use Fintech\Core\Services\TranslationService;

class Core
{
    public function setting($filters = null)
    {
        return \singleton(SettingService::class, $filters);
    }

    public function apiLog($filters = null)
    {
        return \singleton(ApiLogService::class, $filters);
    }

    public function failedJob($filters = null)
    {
        return \singleton(FailedJobService::class, $filters);
    }

    public function job($filters = null)
    {
        return \singleton(JobService::class, $filters);
    }

    public function schedule($filters = null)
    {
        return \singleton(ScheduleService::class, $filters);
    }

    public function translation($filters = null)
    {
        return \singleton(TranslationService::class, $filters);
    }

    /**
     * @return \Fintech\Core\Services\JobBatchService
     */
    public function jobBatch()
    {
        return app(\Fintech\Core\Services\JobBatchService::class);
    }

    /**
     * @return \Fintech\Core\Services\ClientErrorService
     */
    public function clientError()
    {
        return app(\Fintech\Core\Services\ClientErrorService::class);
    }

    /**
     * @return \Fintech\Core\Services\MailService
     */
    public function mail()
    {
        return app(\Fintech\Core\Services\MailService::class);
    }

    /**
     * @return \Fintech\Core\Services\MigrationService
     */
    public function migration()
    {
        return app(\Fintech\Core\Services\MigrationService::class);
    }

    //** Crud Service Method Point Do not Remove **//


    /**
     * verify if a available addon or package is installed
     *
     * @param string $name
     * @param bool $throw
     * @return bool
     * @throws PackageNotInstalledException
     */
    public function packageExists(string $name, bool $throw = false): bool
    {
        $name = \Illuminate\Support\Str::studly($name);

        $proof = class_exists("\Fintech\\{$name}\Facades\\{$name}");

        if ($throw && !$proof) {
            throw new PackageNotInstalledException($name);
        }

        return $proof;
    }

    /**
     * Return an instance of package class if available
     *
     * @param string $name
     * @return mixed
     * @throws PackageNotInstalledException
     */
    public static function launch(string $name = 'Core'): mixed
    {
        $name = \Illuminate\Support\Str::studly($name);

        (new self())->packageExists($name, true);

        $abstract = "\Fintech\\{$name}\\{$name}";

        return app($abstract);
    }
}

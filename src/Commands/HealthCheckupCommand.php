<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Throwable;

/**
 * Class InstallCommand
 */
class HealthCheckupCommand extends Command
{
    use HasCoreSetting;

    public $signature = 'core:health-checkup';
    public $description = 'Configure the system for the `fintech/core` module';
    private string $module = 'Core';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        $this->setPermissions();

        $this->task("Clear cached bootstrap files", function () {
            Artisan::call('optimize:clear --quiet');
        });

        $this->task("Publish default assets", function () {
            Artisan::call('vendor:publish --tag=fintech-auth-assets --quiet --force');
        });

        $this->task("Publish file manager assets", function () {
            Artisan::call('vendor:publish --tag=fm-assets --quiet --force');
        });

        $this->task("Flush permission cache", function () {
            Artisan::call('permission:cache-reset --quiet');
        });

        $this->task("Verify scheduler log file", function () {
            if (!file_exists(storage_path('/logs/scheduler.log'))) {
                @file_put_contents(storage_path('/logs/scheduler.log'), '');
            }
        });

        $this->task("Verify queue worker log file", function () {
            if (!file_exists(storage_path('/logs/worker.log'))) {
                @file_put_contents(storage_path('/logs/worker.log'), '');
            }
        });

        $this->checkAvailablePackages();

        $this->setPermissions();

        $this->task("Broadcast queue restart signal", function () {
            Artisan::call('queue:restart --quiet');
        });

        return self::SUCCESS;
    }

    private function checkAvailablePackages(): void
    {
        foreach (config('fintech.core.packages', []) as $code => $package) {
            $this->module = $package;
            (config("fintech.{$code}.enabled", false))
                ? $this->successMessage("API routes", "ENABLED", false)
                : $this->errorMessage("API routes", "DISABLED", false);
        }

        $this->module = 'Core';
    }

    /**
     * @throws Throwable
     */
    private function setPermissions()
    {
        if (PHP_OS_FAMILY == "Linux") {
            $this->task("Verify storage directory permission", function () {
                shell_exec('sudo chown -R ubuntu:ubuntu /var/www/html/storage');
                shell_exec('sudo chmod -R 777 /var/www/html/storage');
            });
        }
    }
}

<?php

namespace Fintech\Core\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Class InstallCommand
 */
class HealthCheckupCommand extends Command
{
    private string $module = 'Core';
    public $signature = 'core:health-checkup';
    public $description = 'Configure the system for the `fintech/core` module';

    public function handle(): int
    {
        $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Publish default assets", function () {
            Artisan::call('vendor:publish --tag=fintech-auth-assets --quiet --force');
        });

        $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Publish file manager assets", function () {
            Artisan::call('vendor:publish --tag=fm-assets --quiet --force');
        });

        $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Broadcast queue restart signal", function () {
            Artisan::call('queue:restart --quiet');
        });

        $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Verify scheduler log file", function () {
            if (!file_exists(storage_path('/logs/scheduler.log'))) {
                @file_put_contents(storage_path('/logs/scheduler.log'), '');
            }
        });

        $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Verify queue worker log file", function () {
            if (!file_exists(storage_path('/logs/worker.log'))) {
                @file_put_contents(storage_path('/logs/worker.log'), '');
            }
        });

        if (PHP_OS_FAMILY == "Linux") {
            $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Verify storage directory permission", function () {
                shell_exec('sudo chmod -R 755 /var/www/html/storage');
                shell_exec('sudo chown -R www-data:www-data /var/www/html/storage');
            });
        }

        return self::SUCCESS;
    }
}

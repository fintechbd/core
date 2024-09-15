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
        if (PHP_OS_FAMILY == "Linux") {
            $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Verify storage directory permission", function () {
                shell_exec('sudo chown -R www-data:www-data /var/www/html/storage');
                shell_exec('sudo chmod -R 777 /var/www/html/storage');
            });
        }

        $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Clear cached bootstrap files", function () {
            Artisan::call('optimize:clear --quiet');
        });

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

        $this->checkAvailablePackages();

        return self::SUCCESS;
    }

    private function checkAvailablePackages(): void
    {
        foreach (config('fintech.core.packages', []) as $code => $package) {
            $this->components->twoColumnDetail(
                "<fg=black;bg=bright-yellow;options=bold> {$this->module} </> Package <fg=bright-blue;options=bold>{$package}</> status",
                "<fg=green;options=bold>INSTALLED</>"
            );

            $this->components->twoColumnDetail(
                "<fg=black;bg=bright-yellow;options=bold> {$this->module} </> Package <fg=bright-blue;options=bold>{$package}</> routes",
                (config("fintech.{$code}.enabled", false) ? "<fg=green;options=bold>ENABLED</>" : "<fg=red;options=bold>DISABLED</>")
            );
        }
    }
}

<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Exceptions\AlreadyLatestVersionException;
use Fintech\Core\Supports\Updater;
use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class AppUpdateCommand extends Command
{
    use HasCoreSetting;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private string $module = 'Core';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        /**
         * @var Updater $updater
         */
        $updater = app()->make(Updater::class);

        try {
            $this->infoMessage("Application Upgrade", 'RUNNING', false);

            $this->infoMessage("Current version", $updater->current(), false);

            if (version_compare($updater->latest(), $updater->current(), '<=')) {
                throw new AlreadyLatestVersionException($updater->latest());
            }

            $this->successMessage("New Version Detected", $updater->latest(), false);

            foreach ($updater->availableVersions() as $version => $task) {
                $this->task("Executing Version v{$version} tasks", $task);
            }
            
            $this->call('core:health-checkup');

            $this->successMessage("Application Upgrade", 'COMPLETE', false);

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->errorMessage($e->getMessage());
            $this->errorMessage("Application Upgrade", 'FAILED', false);

            return self::FAILURE;
        }
    }

    public function passableOptions(...$only): array
    {
        $options = [];

        foreach ($only as $key) {
            $options["--{$key}"] = $this->option($key);
        }

        return $options;
    }
}

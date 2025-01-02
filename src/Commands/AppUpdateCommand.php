<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Exceptions\AlreadyLatestVersionException;
use Fintech\Core\Supports\Updater;
use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;

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
    protected $description = 'Update the application from changelog.';

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

            $this->infoMessage("Latest Version Detected", $updater->latest(), false);

            foreach ($updater->availableVersions() as $version => $task) {

                $this->task("Executed version <fg=bright-yellow;options=bold>{$version}</> tasks", $task);

                $updater->setCurrent($version);
            }

            $this->call('core:health-checkup');

            $this->successMessage("Application updated version", $updater->current(), false);

            $this->successMessage("Application upgrade", 'COMPLETE', false);

            return self::SUCCESS;

        } catch (AlreadyLatestVersionException $e) {

            $this->errorMessage($e->getMessage(), 'ERROR', false);
            $this->successMessage("Application Upgrade", 'SKIPPED', false);

        } catch (\Exception $e) {

            $this->errorMessage($e->getMessage());
            $this->errorMessage("Application Upgrade", 'FAILED', false);
        }
        return self::FAILURE;
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

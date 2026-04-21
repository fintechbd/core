<?php

namespace Fintech\Core\Changelogs;

use Fintech\Core\Commands\AppUpdateCommand;
use Fintech\Core\Contracts\Changelog;
use Fintech\Core\Exceptions\PackageNotInstalledException;
use Illuminate\Support\Facades\Artisan;

class Version106 implements Changelog
{

    /**
     * This command will run and apply the changes when the app update command is executed.
     * You can use this to run any database migrations, seeders, or any other changes
     * that need to be applied when the app is updated.
     *
     * @param AppUpdateCommand $command
     * @return void
     * @throws PackageNotInstalledException|\Throwable
     */
    public function handle(AppUpdateCommand $command): void
    {
        $command->task('Moving Schedule Table to Main DB', function () {
            \Fintech\Core\Facades\Core::migration()->list(['migration' => [
                '2024_09_13_120926_create_schedules_table',
                '2024_09_15_054031_update_columns_in_schedules_table'
            ]])
                ->each(function ($migration) {
                    \Fintech\Core\Facades\Core::migration()->destroy($migration->getKey());
                });
            Artisan::call('migrate', ['--force' => true, '--quiet' => true, '--ansi' => true]);
        });
    }
}
<?php

namespace Fintech\Core\Changelogs;

use Fintech\Core\Commands\AppUpdateCommand;
use Fintech\Core\Contracts\Changelog;
use Fintech\Core\Exceptions\PackageNotInstalledException;
use Illuminate\Support\Facades\Artisan;

class Version108 implements Changelog
{

    /**
     * This command will run and apply the changes when the app update command is executed.
     * You can use this to run any database migrations, seeders, or any other changes
     * that need to be applied when the app is updated.
     *
     * @param AppUpdateCommand $command
     * @return void
     * @throws PackageNotInstalledException
     */
    public function handle(AppUpdateCommand $command): void
    {
        $command->task('Setup Agrani Bank Vendor Configuration', function () {
            Artisan::call('remit:agrani-bank-setup', ['--ansi' => true]);
        });
    }
}
<?php

namespace Fintech\Core\Changelogs;

use Fintech\Core\Commands\AppUpdateCommand;
use Fintech\Core\Contracts\Changelog;
use Fintech\Core\Exceptions\PackageNotInstalledException;

class Version103 implements Changelog
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
        if (\Fintech\Core\Facades\Core::packageExists('Business')) {
            \Fintech\Business\Facades\Business::serviceType()->list()->each(function ($service) use ($command) {
                $service->enabled = true;
                if ($service->save()) {
                    $command->successMessage("[<fg=bright-yellow;options=bold>{$service->service_type_name}</>] service type has been updated", 'DONE', false);
                }
            });

            \Fintech\Business\Facades\Business::serviceStat()->list()->each(function ($serviceStat) use ($command) {
                $serviceStat->enabled = true;
                if ($serviceStat->save()) {
                    $command->successMessage("[<fg=bright-yellow;options=bold>{$serviceStat->id}</>] service stat has been updated", 'DONE', false);
                }
            });
        }
    }
}
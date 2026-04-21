<?php

namespace Fintech\Core\Contracts;

use Fintech\Core\Commands\AppUpdateCommand;

interface Changelog
{
    /**
     * This command will run and apply the changes when the app update command is executed.
     * You can use this to run any database migrations, seeders, or any other changes
     * that need to be applied when the app is updated.
     *
     * @param AppUpdateCommand $command
     * @return void
     */
    public function handle(AppUpdateCommand $command): void;
}

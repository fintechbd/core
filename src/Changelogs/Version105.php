<?php

namespace Fintech\Core\Changelogs;

use Fintech\Core\Commands\AppUpdateCommand;
use Fintech\Core\Contracts\Changelog;
use Fintech\Core\Exceptions\PackageNotInstalledException;

class Version105 implements Changelog
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
        $command->task('Register schedule tasks', function () {

            $task = [
                'name' => 'Fire Scheduled Notification Event',
                'description' => 'This schedule program fire any scheduled notification event.',
                'command' => 'bell:scheduled-notification',
                'enabled' => true,
                'timezone' => 'UTC',
                'interval' => '*/5 * * * *',
                'priority' => 5,
            ];

            $taskModel = \Fintech\Core\Facades\Core::schedule()->findWhere(['command' => $task['command']]);

            if ($taskModel) {
                return;
            }

            \Fintech\Core\Facades\Core::schedule()->create($task);
        });
    }
}
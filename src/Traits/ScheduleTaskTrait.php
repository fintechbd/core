<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Facades\Core;
use Illuminate\Console\Scheduling\Schedule;

trait ScheduleTaskTrait
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $tasks = Core::schedule()->list(['enabled' => true, 'sort' => 'priority', 'dir' => 'asc']);

        foreach ($tasks as $task) {
            $schedule
                ->command($task->command, $task->parameters)
                ->timezone($task->timezone)
                ->appendOutputTo(storage_path('logs/scheduler.log'))
                ->cron(($task->interval ?? '0 0 0 0 0'))
                ->pingBefore(route('core.schedules.health', [$task->id, 'triggered']))
                ->pingOnSuccess(route('core.schedules.health', [$task->id, 'succeed']))
                ->pingOnFailure(route('core.schedules.health', [$task->id, 'failed']))
            ;
        }

    }
}

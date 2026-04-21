<?php

namespace Fintech\Core\Providers;

use Fintech\Core\Facades\Core;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'production') {
            $this->app->booted(function () {

                $schedule = app(\Illuminate\Console\Scheduling\Schedule::class);

                Core::schedule()
                    ->list(['enabled' => true, 'sort' => 'priority', 'dir' => 'asc'])
                    ->each(function ($task) use ($schedule) {
                        $schedule
                            ->command($task->command, $task->parameters)
                            ->timezone($task->timezone)
                            ->appendOutputTo(storage_path('logs/scheduler.log'))
                            ->cron(($task->interval ?? '0 0 0 0 0'))
                            ->pingBefore(route('core.schedules.health', [$task->id, 'triggered']))
                            ->pingOnSuccess(route('core.schedules.health', [$task->id, 'succeed']))
                            ->pingOnFailure(route('core.schedules.health', [$task->id, 'failed']));
                    });
            });
        }
    }
}

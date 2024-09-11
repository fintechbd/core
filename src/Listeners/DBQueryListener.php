<?php

namespace Fintech\Core\Listeners;

class DBQueryListener
{
    public function handle(\Illuminate\Database\Events\QueryExecuted $event): void
    {
        if (\config('fintech.core.query_logger_enabled') && \config('database.default') != 'mongodb') {

            if (app()->runningInConsole() && !\config('fintech.core.log_console_query')) {
                return;
            }

            $query = \Illuminate\Support\Str::replaceArray('?', $event->bindings, $event->sql);

            \Illuminate\Support\Facades\Log::channel('query')->debug("TIME: {$event->time} ms, SQL: {$query}");
        }
    }
}

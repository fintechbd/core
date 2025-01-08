<?php

namespace Fintech\Core\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function config;

class DBQueryListener
{
    public function handle(QueryExecuted $event): void
    {
        $whitelist = config('fintech.core.whitelist_query', []);

        if (config('fintech.core.query_logger_enabled') && config('database.default') != 'mongodb') {

            if (app()->runningInConsole() && !config('fintech.core.log_console_query')) {
                return;
            }

            if (!empty($whitelist) && Str::contains($event->sql, $whitelist)) {
                return;
            }

            $query = Str::replaceArray('?', $event->bindings, $event->sql);

            Log::channel('query')->debug("TIME: {$event->time} ms, SQL: {$query}");
        }
    }
}

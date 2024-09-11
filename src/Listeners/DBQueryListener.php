<?php

namespace Fintech\Core\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DBQueryListener
{
    /**
     * Handle the event.
     */
    public function handle(QueryExecuted $event): void
    {
        if (Config::get('fintech.core.query_logger_enabled') && Config::get('database.default') != 'mongodb') {
            DB::listen(function (QueryExecuted $event) {
                if ($this->app->runningInConsole() && !config('fintech.core.log_console_query')) {
                    return;
                }
                $query = Str::replaceArray('?', $event->bindings, $event->sql);
                Log::channel('query')
                    ->debug("TIME: {$event->time} ms, SQL: {$query}");
            });
        }
    }
}

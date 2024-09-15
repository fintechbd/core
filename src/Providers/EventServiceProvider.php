<?php

namespace Fintech\Core\Providers;

use Fintech\Core\Listeners\ApiRequestListener;
use Fintech\Core\Listeners\DBQueryListener;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Http\Client\Events\ConnectionFailed;
use Illuminate\Http\Client\Events\ResponseReceived;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ResponseReceived::class => [
            ApiRequestListener::class,
        ],
        ConnectionFailed::class => [
            ApiRequestListener::class,
        ],
        QueryExecuted::class => [
            DBQueryListener::class
        ]
    ];
}

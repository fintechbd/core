<?php

namespace Fintech\Core\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \Illuminate\Http\Client\Events\ResponseReceived::class => [
            \Fintech\Core\Listeners\ApiRequestListener::class,
        ],
        \Illuminate\Http\Client\Events\ConnectionFailed::class => [
            \Fintech\Core\Listeners\ApiRequestListener::class,
        ],
        \Illuminate\Database\Events\QueryExecuted::class => [
            \Fintech\Core\Listeners\DBQueryListener::class
        ]
    ];
}

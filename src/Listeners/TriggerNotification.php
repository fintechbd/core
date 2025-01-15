<?php

namespace Fintech\Core\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;

class TriggerNotification implements ShouldQueue
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'notification';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 0;

    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $aliases = $event->aliases();
    }
}

<?php

namespace Fintech\Core\Listeners;

use Fintech\Core\Facades\Core;
use Illuminate\Contracts\Queue\ShouldQueue;

class TriggerListener implements ShouldQueue
{
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
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $variables = $event->variables();

        if (Core::packageExists('Auth')) {

            $whitelist = config('fintech.auth.geoip.whitelist', []);

            if (!empty($variables['__ip__']) &&
                !in_array($variables['__ip__'], $whitelist)) {
                $ipInfo = \Fintech\Auth\Facades\Auth::geoip()->find($variables['__ip__']);
                $variables['__location__'] = $ipInfo['city'] . ', ' . $ipInfo['region_name'] . ', ' . $ipInfo['country_name'] . '.';
                $variables['__latitude__'] = round($ipInfo['latitude'], 5);
                $variables['__longitude__'] = round($ipInfo['longitude'], 5);
            }
        }

        if (Core::packageExists('Bell')) {
            \Fintech\Bell\Facades\Bell::notification()->handle($event, $variables);
        }
    }
}

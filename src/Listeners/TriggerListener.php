<?php

namespace Fintech\Core\Listeners;

use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Enums\Bell\NotificationMedium;
use Fintech\Core\Facades\Core;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

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
            foreach ($event->templates() as $template) {
                Notification::send($this->recipients($event, $template), new \Fintech\Bell\Notifications\DynamicNotification($template->medium, $template->content, $variables));
            }
        }
    }

    private function systemAdmin(): null|Authenticatable|BaseModel
    {
        if (Core::packageExists('Auth')) {
            return \Fintech\Auth\Facades\Auth::user()->findWhere(['id' => 1]);
        }

        return null;
    }

    private function eventUser($event): null|Authenticatable|BaseModel
    {
        if (property_exists($event, 'user')) {
            return $event->user;
        }

        return null;
    }

    private function eventAgent($event): null|Authenticatable|BaseModel
    {
        if (property_exists($event, 'agent')) {
            return $event->agent;
        }

        return null;
    }

    private function recipients(object $event, object $template): Collection
    {
        $templateRecipients = $template->recipients;

        $recipients = collect();

        if (isset($templateRecipients['admin']) && $templateRecipients['admin'] === true) {
            if ($admin = $this->systemAdmin()) {
                $recipients->push($admin);
            }
        }

        if (isset($templateRecipients['customer']) && $templateRecipients['customer'] === true) {
            if ($customer = $this->eventUser($event)) {
                $recipients->push($customer);
            }
        }

        if (isset($templateRecipients['agent']) && $templateRecipients['agent'] === true) {
            if ($agent = $this->eventAgent($event)) {
                $recipients->push($agent);
            }
        }

        foreach ($templateRecipients['extra'] as $recipient) {
            $recipient = trim($recipient);

            if ($template->medium == NotificationMedium::Sms) {
                if (preg_match('/^\+[1-9]\d{9,14}$/i', $recipient) === 1) {
                    $recipients->push(Notification::route(NotificationMedium::Sms->value, $recipient));
                }
            } elseif ($template->medium == NotificationMedium::Email) {
                if (filter_var($recipient, FILTER_VALIDATE_EMAIL) !== false) {
                    $recipients->push(Notification::route(NotificationMedium::Email->value, [$recipient => 'Anonymous Notification']));
                }
            } elseif ($template->medium == NotificationMedium::Chat) {
                if (filter_var($recipient, FILTER_VALIDATE_INT) !== false && Core::packageExists('Auth')) {
                    if ($user = \Fintech\Auth\Facades\Auth::user()->find($recipient)) {
                        $recipients->push($user);
                    }
                }
            } elseif ($template->medium == NotificationMedium::Push) {
                $recipients->push($recipient);
            }
        }

        return $recipients->filter(fn ($recipient) => gettype($recipient) == 'object');
    }
}

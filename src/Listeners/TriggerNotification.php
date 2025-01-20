<?php

namespace Fintech\Core\Listeners;

use Fintech\Auth\Facades\Auth;
use Fintech\Bell\Notifications\ChatNotification;
use Fintech\Bell\Notifications\EmailNotification;
use Fintech\Bell\Notifications\LogNotification;
use Fintech\Bell\Notifications\PushNotification;
use Fintech\Bell\Notifications\SmsNotification;
use Fintech\Core\Enums\Bell\NotificationMedium;
use Fintech\Core\Facades\Core;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class TriggerNotification implements ShouldQueue
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
     * Create the event listener.
     */
    public function __construct()
    {

    }


    public function systemAdmin()
    {
        if (Core::packageExists('Auth')) {
            return \Fintech\Auth\Facades\Auth::user()->findWhere(['id' => 1]);
        }

        return null;
    }

    public function eventUser($event)
    {
        if (Core::packageExists('Auth') && property_exists($event, 'user')) {
            return $event->user;
        }

        return null;
    }

    public function eventAgent($event)
    {
        if (Core::packageExists('Auth') && property_exists($event, 'agent')) {
            return $event->agent;
        }

        return null;
    }


    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $variables = $event->variables();

        $templates = $event->templates();

        foreach ($templates as $template) {
            $recipients = $this->recipients($event, $template->recipients);
            match ($template->medium) {
                NotificationMedium::Sms => Notification::send($recipients, new SmsNotification($template, $variables)),
                NotificationMedium::Email => Notification::send($recipients, new EmailNotification($template, $variables)),
                NotificationMedium::Push => Notification::send($recipients, new PushNotification($template, $variables)),
                NotificationMedium::Chat => Notification::send($recipients, new ChatNotification($template, $variables)),
                default => Notification::send($recipients, new LogNotification($template, $variables)),
            };
        }
    }

    public function recipients(object $event, array $recipients = []): Collection
    {
        $users = collect();

        $userService = Auth::user();

        if (isset($recipients['admin']) && $recipients['admin'] === true) {
            if ($admin = $this->systemAdmin()) {
                $users->push($admin);
            }
        }

        if (isset($recipients['customer']) && $recipients['customer'] === true) {
            if ($customer = $this->eventUser($event)) {
                $users->push($customer);
            }
        }

        if (isset($recipients['agent']) && $recipients['agent'] === true) {
            if ($agent = $this->eventAgent($event)) {
                $users->push($agent);
            }
        }

        //        if (!empty($recipients['extra'])) {
        //            if ($admin = $userService->findWhere(['id' => 1])) {
        //                $users->push($admin);
        //            }
        //        }

        return $users->unique();
    }
}

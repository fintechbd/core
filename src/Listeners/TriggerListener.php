<?php

namespace Fintech\Core\Listeners;

use Fintech\Auth\Facades\Auth;
use Fintech\Bell\Notifications\DynamicNotification;
use Fintech\Core\Abstracts\BaseModel;
use Fintech\Core\Enums\Bell\NotificationMedium;
use Fintech\Core\Facades\Core;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $variables = $event->variables();

        $templates = $event->templates();

        foreach ($templates as $template) {

            [$users,$anonymous] = $this->recipients($event, $template);

            if ($users->isNotEmpty()) {
                Notification::send($users, new DynamicNotification($template, $variables));
            }

            if ($anonymous->isNotEmpty()) {}
                Notification::route($users)->notify(new DynamicNotification($template, $variables));

        }
    }

    private function systemAdmin(): null|Authenticatable|BaseModel
    {
        if (Core::packageExists('Auth')) {
            return Auth::user()->findWhere(['id' => 1]);
        }

        return null;
    }

    private function eventUser($event): null|Authenticatable|BaseModel
    {
        if (Core::packageExists('Auth') && property_exists($event, 'user')) {
            return $event->user;
        }

        return null;
    }

    private function eventAgent($event): null|Authenticatable|BaseModel
    {
        if (Core::packageExists('Auth') && property_exists($event, 'agent')) {
            return $event->agent;
        }

        return null;
    }

    private function recipients(object $event, object $template): Collection
    {
        $users = collect();

        $recipients = $template->recipients;

        $extraRecipients = collect();

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

        if (!empty($recipients['extra'])) {
            if ($admin = $userService->findWhere(['id' => 1])) {
                $users->push($admin);
            }
        }

        return $users->unique();
    }
}

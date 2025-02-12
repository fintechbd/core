<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Facades\Core;
use Illuminate\Console\Command;

class ScheduledNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:scheduled-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduled notification trigger command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Core::packageExists('Bell')) {
            \Fintech\Bell\Facades\Bell::template([
                'trigger_code' => \Fintech\Bell\Events\ScheduledTrigger::class,
                'triggered' => false,
                'scheduled' => true,
                ])->each(function ($trigger) {

                });
        }

    }
}

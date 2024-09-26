<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Facades\Core;
use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppInstallCommand extends Command
{
    use HasCoreSetting;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private string $module = 'Core';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        $this->task("Prepare database", function () {
            Artisan::call('db:wipe --drop-views --force --quiet');
        });

        $this->task("Running migrations", function () {
            Artisan::call('migrate:fresh --force --quiet');
        });

        $this->call('core:install');

        if (Core::packageExists('Auth')) {
            $this->call('auth:install');
        }

        if (Core::packageExists('MetaData')) {
            $this->call('metadata:install', ['--states' => true, '--cities' => true]);
        }

        if (Core::packageExists('Banco')) {
            $this->call('banco:install', ['--countries' => 'BD,CA,AE']);
        }

        if (Core::packageExists('Transaction')) {
            $this->call('transaction:install');
        }

        if (Core::packageExists('Business')) {
            $this->call('business:install');
        }

        if (Core::packageExists('Reload')) {
            $this->call('reload:install');
        }

        if (Core::packageExists('Remit')) {
            $this->call('remit:install');
        }

        if (Core::packageExists('Airtime')) {
            $this->call('airtime:install');
        }

        if (Core::packageExists('Tab')) {
            $this->call('tab:install');
        }

        if (Core::packageExists('Bell')) {
            $this->call('bell:install');
        }

        if (Core::packageExists('Card')) {
            $this->call('card:install');
        }

        if (Core::packageExists('Gift')) {
            $this->call('gift:install');
        }

        if (Core::packageExists('Sanction')) {
            $this->call('sanction:install');
        }

        Artisan::call('core:health-checkup');

        $this->components->info('Run database seed command to finalize the setup.');
    }
}

<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Facades\Core;
use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class AppInstallCommand extends Command
{
    use HasCoreSetting;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install
                            {--states : Seed states data if metadata modules installed}
                            {--cities : Seed cities data if metadata modules installed}
                            {--countries= : Seed which country banks data if bank modules installed}';

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
        try {

            if (Config::get('database.connections.support') == null) {
                $this->components->error('Missing `support` connection in database configuration.');
                $this->comment("'support' => [
    'driver' => 'sqlite',
    'url' => env('DATABASE_URL'),
    'database' => storage_path('app' . DIRECTORY_SEPARATOR . 'support.sqlite'),
    'prefix' => '',
    'foreign_key_constraints' => false,
],");
                $this->components->info("Add given lines inside of  `config/database.php` files `connections` array than try again.");
                return self::FAILURE;
            }

            $this->task("Prepare database", function () {
                Artisan::call('db:wipe --drop-views --force --quiet');
            });

            $this->task("Creating support database", function () {
                if (Config::get('database.connections.support.driver') == 'sqlite') {
                    @file_put_contents(storage_path('app' . DIRECTORY_SEPARATOR . 'support.sqlite'), '');
                } else {
                    Artisan::call('db:wipe --drop-views --database=support --force --quiet');
                }
            });

            $this->task("Running migrations", function () {
                Artisan::call('migrate:fresh --force --quiet');
            });

            $this->call('core:install', $this->passableOptions());

            if (Core::packageExists('Auth')) {
                $this->call('auth:install', $this->passableOptions());
            }

            if (Core::packageExists('MetaData')) {
                $this->call('metadata:install', $this->passableOptions('states', 'cities'));
            }

            if (Core::packageExists('Banco')) {
                $this->call('banco:install', $this->passableOptions('countries'));
            }

            if (Core::packageExists('Transaction')) {
                $this->call('transaction:install', $this->passableOptions());
            }

            if (Core::packageExists('Business')) {
                $this->call('business:install', $this->passableOptions());
            }

            if (Core::packageExists('Reload')) {
                $this->call('reload:install', $this->passableOptions());
            }

            if (Core::packageExists('Remit')) {
                $this->call('remit:install', $this->passableOptions());
            }

            if (Core::packageExists('Airtime')) {
                $this->call('airtime:install', $this->passableOptions());
            }

            if (Core::packageExists('Tab')) {
                $this->call('tab:install', $this->passableOptions());
            }

            if (Core::packageExists('Bell')) {
                $this->call('bell:install', $this->passableOptions());
            }

            if (Core::packageExists('Card')) {
                $this->call('card:install', $this->passableOptions());
            }

            if (Core::packageExists('Gift')) {
                $this->call('gift:install', $this->passableOptions());
            }

            if (Core::packageExists('Sanction')) {
                $this->call('sanction:install', $this->passableOptions());
            }

            sleep(10);

            $this->call('core:health-checkup', $this->passableOptions());

//            $this->call('db:seed', $this->passableOptions());

            $this->components->info('Run database seed command to finalize the setup.');

            return self::SUCCESS;

        } catch (\Exception $e) {
            throw $e;
            return self::FAILURE;
        }
    }

    public function passableOptions(...$only): array
    {
        $options = [];

        foreach ($only as $key) {
            $options["--{$key}"] = $this->option($key);
        }

        return $options;
    }
}

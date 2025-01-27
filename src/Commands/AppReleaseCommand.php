<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;

class AppReleaseCommand extends Command
{
    use HasCoreSetting;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:app-release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Building application for server release';

    private string $module = 'Core';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        try {
            $this->infoMessage("Application Release", 'RUNNING', false);

            dd(config('fintech.core.packages'));

            $this->call('core:health-checkup');

            $this->successMessage("Application Release", 'COMPLETE', false);

            return self::SUCCESS;

        } catch (\Exception $e) {

            $this->errorMessage($e->getMessage());
            $this->successMessage("Build Process", 'FAILED', false);
            $this->errorMessage("Application Release", 'SKIPPED', false);
        }
        return self::FAILURE;
    }

}

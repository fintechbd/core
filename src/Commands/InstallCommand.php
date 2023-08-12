<?php

namespace Fintech\Core\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'core:install';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

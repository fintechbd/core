<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;
use Throwable;

/**
 * Class InstallCommand
 */
class GenerateLangFileCommand extends Command
{
    use HasCoreSetting;

    public $signature = 'core:generate-lang-file';
    public $description = 'Generate language JSON files.';
    private string $module = 'Core';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        try {


            return self::SUCCESS;

        } catch (Throwable $e) {

            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}

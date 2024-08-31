<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Traits\HasCoreSettingTrait;
use Illuminate\Console\Command;

/**
 * Class InstallCommand
 */
class InstallCommand extends Command
{
    use HasCoreSettingTrait;

    private string $module = 'Core';
    public $signature = 'core:install';
    public $description = 'Configure the system for the `fintech/core` module';
    private array $settings = [
        [
            'package' => 'core',
            'label' => 'Pagination Style',
            'description' => 'What type of pagination will display in list view',
            'key' => 'pagination_type',
            'type' => 'string',
            'value' => 'paginate'
        ]
    ];

    public function handle(): int
    {
        $this->addSettings();

        $this->components->twoColumnDetail("[<fg=yellow;options=bold>{$this->module}</>] Installation", "<fg=green;options=bold>COMPLETED</>");

        return self::SUCCESS;
    }
}

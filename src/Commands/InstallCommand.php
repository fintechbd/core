<?php

namespace Fintech\Core\Commands;

use Fintech\Core\Traits\HasCoreSettingTrait;
use Illuminate\Console\Command;
use Throwable;

/**
 * Class InstallCommand
 */
class InstallCommand extends Command
{
    use HasCoreSettingTrait;

    public $signature = 'core:install';
    public $description = 'Configure the system for the `fintech/core` module';
    private string $module = 'Core';
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

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        $this->infoMessage("Module Installation", 'RUNNING');

        $this->task("Module Installation", function () {
            $this->addSettings();
        });

        return self::SUCCESS;
    }
}

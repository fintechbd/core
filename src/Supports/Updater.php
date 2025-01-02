<?php

namespace Fintech\Core\Supports;

use Illuminate\Support\Facades\Config;

class Updater
{
    private $filepath;
    private string $currentVersion = '1.0.0';
    private string $latestVersion = '1.0.1';
    private array $changelog = [];
    private array $aheadVersions = [];

    public function __construct()
    {
        $this->filepath = storage_path('app/version');

        $this->loadVersions();
    }

    private function loadVersions(): void
    {
        $this->currentVersion = trim(file_get_contents($this->filepath));

        $this->changelog = Config::get('fintech.changelog', []);

        uksort($this->changelog, 'version_compare');

        $this->latestVersion = array_key_last($this->changelog);

        foreach ($this->changelog as $version => $task) {
            if (version_compare($version, $this->currentVersion, '>')) {
                $this->aheadVersions[$version] = $task;
            }
        }

    }

    public function current(): string
    {
        return $this->currentVersion;
    }


    public function availableVersions(): array
    {
        return $this->aheadVersions;
    }

    public function latest(): string
    {
        return $this->latestVersion;

    }

    public function setCurrent(string $version): void
    {
        @file_put_contents($this->filepath, $version);
    }
}

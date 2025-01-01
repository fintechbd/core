<?php

namespace Fintech\Core\Supports;

class Updater
{
    private $filepath;
    private string $currentVersion = '1.0.0';
    private string $latestVersion = '1.0.1';
    private array $changelog = [];

    public function __construct()
    {
        $this->filepath = storage_path('app/version');
        $this->loadVersions();
    }

    private function loadVersions(): void
    {
        $this->currentVersion = trim(file_get_contents($this->filepath));


    }

    public function current(): string
    {
        return $this->currentVersion;
    }

    public function latest(): string
    {
        return $this->latestVersion;

    }
}

<?php

namespace Fintech\Core;

use Fintech\Core\Services\SettingService;

class Core
{
    /**
     * @return SettingService
     */
    public function setting()
    {
        return app(SettingService::class);
    }

    /**
     * verify if a available addon or package is installed
     *
     * @param string $name
     * @return bool
     */
    public function packageExists(string $name): bool
    {

        return class_exists("\Fintech\\{$name}\Facades\\{$name}::class");
    }

    public function extFromMime(string $mime)
    {

    }
}

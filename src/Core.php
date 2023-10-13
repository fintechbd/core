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
}

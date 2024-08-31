<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Facades\Core;
use Illuminate\Support\Facades\DB;

trait HasCoreSettingTrait
{
    /**
     * @param string $module
     * @return void
     */
    private function addSettings(string $module = 'fintech/core'): void
    {
        try {
            if (property_exists($this, 'settings')) {
                $this->components->task("[<fg=green;options=bold>{$module}</>] Populating settings", function () {
                    foreach ($this->settings as $setting) {
                        $settingModel = Core::setting()->list([
                            'package' => $setting['package'],
                            'key' => $setting['key'],
                        ])->first();
                        ($settingModel)
                            ? Core::setting()->update($settingModel->id, $setting)
                            : Core::setting()->create($setting);
                    }
                });
                return;
            }
            $this->components->twoColumnDetail(
                "[<fg=green;options=bold>{$module}</>] <fg=red;options=bold>" . __CLASS__ . "</> class is missing the settings property.",
            "<fg=yellow;options=bold>SKIP</>");
        } catch (\Exception $exception) {
            $this->components->twoColumnDetail(
                "[<fg=green;options=bold>{$module}</>] " . $exception->getMessage(),
                "<fg=red;options=bold>ERROR</>");
        }
    }
}

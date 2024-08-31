<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Facades\Core;

trait HasCoreSettingTrait
{
    /**
     * @param string|null $module
     * @return void
     */
    private function addSettings(): void
    {
        try {
            if (property_exists($this, 'settings')) {
                $this->components->task("[<fg=yellow;options=bold>{$this->module}</>] Populating settings", function () {
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
                "[<fg=yellow;options=bold>{$this->module}</>] <fg=red;options=bold>" . __CLASS__ . "</> class is missing the settings property.",
                "<fg=yellow;options=bold>SKIP</>"
            );
        } catch (\Exception $exception) {
            $this->errorMessage($exception->getMessage());
        }
    }

    private function errorMessage(string $message): void
    {
        $this->components->twoColumnDetail("[<fg=yellow;options=bold>{$this->module}</>] {$message}", "<fg=red;options=bold>ERROR</>");
    }
}

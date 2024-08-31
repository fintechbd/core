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
        if (!property_exists($this, 'settings')) {

            $this->components->twoColumnDetail(
                "[" . __CLASS__ . "] class is missing the settings property.",
                '<fg=yellow;options=bold>SKIPPED</>'
            );

            goto completed;
        }

        foreach ($this->settings as $setting) {
            DB::beginTransaction();
            try {
                $settingModel = Core::setting()->list([
                    'package' => $setting['package'],
                    'key' => $setting['key'],
                ])->first();

                ($settingModel)
                    ? Core::setting()->update($settingModel->id, $setting)
                    : Core::setting()->create($setting);

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                $this->components->twoColumnDetail($exception->getMessage(), '<fg=red;options=bold>ERROR</>');
            }
        }

        completed:
        $this->components->twoColumnDetail(
            "<fg=yellow;options=bold>`{$module}`</> module settings synced.",
            '<fg=green;options=bold>SUCCESS</>'
        );
    }
}

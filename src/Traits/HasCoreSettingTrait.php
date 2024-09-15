<?php

namespace Fintech\Core\Traits;

use Exception;
use Fintech\Core\Facades\Core;
use Throwable;

trait HasCoreSettingTrait
{
    private function prefix(): string
    {
        return "<fg=bright-white;bg=bright-blue;options=bold> {$this->module} </> ";
    }

    /**
     * @return void
     * @throws Throwable
     */
    private function addSettings(): void
    {
        try {
            if (property_exists($this, 'settings')) {
                $this->task("Populating settings", function () {
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
                "<fg=white;bg=bright-blue;options=bold> {$this->module} </> <fg=red;options=bold>" . __CLASS__ . "</> class is missing the settings property.",
                "<fg=yellow;options=bold>SKIP</>"
            );
        } catch (Exception $exception) {
            $this->errorMessage($exception->getMessage());
        }
    }

    /**
     * @throws Throwable
     */
    private function task(string $message, $task = null, $doneLabel = 'DONE', $failLabel = 'FAILED'): void
    {
        $startTime = microtime(true);

        $result = false;

        try {
            $result = ($task ?: fn() => true)();
        } catch (Throwable $e) {
            throw $e;
        } finally {
            $runTime = ($task != null) ? number_format((microtime(true) - $startTime) * 1000) . "ms "
                : "";

            $this->components->twoColumnDetail($this->prefix() . $message,
                "<fg=gray>{$runTime}</>" . ($result !== false ? " <fg=green;options=bold>{$doneLabel}</>" : " <fg=red;options=bold>{$failLabel}</>"));
        }
    }

    private function errorMessage(string $message, string $label = 'ERROR'): void
    {
        $this->components->twoColumnDetail($this->prefix() . $message, "<fg=red;options=bold>{$label}</>");
    }

    private function infoMessage(string $message, string $label = 'INFO'): void
    {
        $this->components->twoColumnDetail($this->prefix() . $message, "<fg=bright-yellow;options=bold>{$label}</>");
    }
}

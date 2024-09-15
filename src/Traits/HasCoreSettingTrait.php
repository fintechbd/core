<?php

namespace Fintech\Core\Traits;

use Exception;
use Fintech\Core\Facades\Core;
use Throwable;

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
            $runTime = number_format((microtime(true) - $startTime) * 1000);
            $this->components->twoColumnDetail("<fg=bright-white;bg=bright-blue;options=bold> {$this->module} </> {$message}",
                "<fg=gray>{$runTime}ms</> " . ($result !== false ? " <fg=green;options=bold>{$doneLabel}</>" : " <fg=red;options=bold>{$failLabel}</>"));
        }
    }

    private function errorMessage(string $message): void
    {
        $this->components->twoColumnDetail("<fg=white;bg=bright-blue;options=bold> {$this->module} </> {$message}", "<fg=red;options=bold>ERROR</>");
    }
}

<?php

namespace Fintech\Core\Traits;

use Exception;
use Fintech\Core\Facades\Core;
use Throwable;

trait HasCoreSetting
{
    private function prefix(): string
    {
        return " ";
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
                        $settingModel = Core::setting()->findWhere(['package' => $setting['package'], 'key' => $setting['key']]);
                        ($settingModel)
                            ? Core::setting()->update($settingModel->id, $setting)
                            : Core::setting()->create($setting);
                    }
                });
                return;
            }
            $this->infoMessage("<fg=red;options=bold>" . __CLASS__ . "</> class is missing the settings property.", "SKIP");
        } catch (Exception $exception) {
            $this->errorMessage($exception->getMessage());
        }
    }

    public function task(string $message, $task = null, $doneLabel = 'DONE', $failLabel = 'FAILED'): void
    {
        $startTime = microtime(true);

        $result = false;

        try {
            $result = ($task ?: fn () => true)($this);
        } catch (Throwable $e) {
            throw $e;
        } finally {
            $runTime = ($task != null) ? number_format((microtime(true) - $startTime) * 1000) . "ms "
                : "";

            ($result !== false)
                ? $this->successMessage($message, $doneLabel, false, "<fg=gray>{$runTime}</>")
                : $this->errorMessage($message, $failLabel, false, "<fg=gray>{$runTime}</>");
        }
    }
    public function errorMessage(string $message, string $label = 'ERROR', bool $addNewline = true, string $pretext = ''): void
    {
        $this->customLineMessage($message, $label, $addNewline, $pretext, 'red');
    }
    public function infoMessage(string $message, string $label = 'INFO', bool $addNewline = true, string $pretext = ''): void
    {
        $this->customLineMessage($message, $label, $addNewline, $pretext, 'yellow');
    }
    public function successMessage(string $message, string $label = 'DONE', bool $addNewline = true, string $pretext = ''): void
    {
        $this->customLineMessage($message, $label, $addNewline, $pretext, 'green');
    }
    public function customLineMessage(string $message, string $label, bool $addNewline, string $pretext, string $fgColor = 'white', string $bgColor = ''): void
    {
        if ($addNewline) {
            $this->newLine();
        }
        $this->components->twoColumnDetail("<fg=bright-white;bg=bright-blue;options=bold> {$this->module} </> {$message}", "{$pretext}<fg=bright-{$fgColor};options=bold;bg={$bgColor}>{$label}</>");
    }
}

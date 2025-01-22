<?php

namespace Fintech\Core\Abstracts;

use Fintech\Core\Facades\Core;
use Illuminate\Support\Collection;

abstract class BaseEvent
{
    public $variables = [];

    public $ipAddress;

    public $agent;

    public $templates;

    protected function init(): void
    {
        $this->ip();
        $this->userAgent();
        $this->variables();
    }

    public function ip(): ?string
    {
        if ($this->ipAddress == null && !app()->runningInConsole()) {
            $this->ipAddress = request()->ip();
        }

        return $this->ipAddress;
    }

    public function userAgent(): ?string
    {
        if ($this->agent == null && !app()->runningInConsole()) {
            $this->agent = request()->userAgent();
        }

        return $this->agent;
    }

    public function variables(): array
    {
        if (empty($this->variables)) {
            $this->variables = $this->aliases();
        }

        return $this->variables;
    }

    public function templates()
    {
        if (Core::packageExists('Bell') && $this->templates == null) {
            $this->templates = \Fintech\Bell\Facades\Bell::template()->list(['trigger_code' => get_class($this), 'enabled' => true]);
        }
        return $this->templates == null ? collect() : $this->templates;
    }
}

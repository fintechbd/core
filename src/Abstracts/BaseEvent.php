<?php

namespace Fintech\Core\Abstracts;

abstract class BaseEvent
{
    public $variables = [];

    public $ipAddress;

    public $agent;

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

}

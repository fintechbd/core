<?php

namespace Fintech\Core\Attributes;

class Recipient
{
    /**
     * @param string $name
     * @param string $description
     * @param bool $enabled
     * @param array $variables
     * @param array $recipients
     */
    public function __construct(
        private string $name = '',
        private string $description = '',
        private bool   $enabled = false
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }
}

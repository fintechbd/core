<?php

namespace Fintech\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ListenByTrigger
{
    /**
     * @param string $name
     * @param string $description
     * @param bool $enabled
     * @param bool $anonymous event don't have user model reference
     * @param array $variables
     * @param array $recipients
     */
    public function __construct(
        private string $name = '',
        private string $description = '',
        private bool   $enabled = false,
        private bool   $anonymous = false,
        private array  $variables = [],
        private array  $recipients = [],
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

    /**
     * @return Variable[]
     */
    public function variables(): array
    {
        return $this->variables;
    }

    /**
     * @return bool
     */
    public function isAnonymous(): bool
    {
        return $this->anonymous;
    }

    /**
     * @return Recipient[]
     */
    public function recipients(): array
    {
        return $this->recipients;
    }

}

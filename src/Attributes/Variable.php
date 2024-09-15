<?php

namespace Fintech\Core\Attributes;

class Variable
{
    /**
     * @param string $name
     * @param string $description
     */
    public function __construct(
        public string $name = '',
        public string $description = ''
    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }
}

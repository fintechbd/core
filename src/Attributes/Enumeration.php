<?php

namespace Fintech\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Enumeration
{
    /**
     * @param string|null $color
     * @param string|null $hex Hex Color including Hash value
     * @param string|null $description
     * @param string|null $label
     */
    public function __construct(
        private ?string $color = '',
        private ?string $hex = '',
        private ?string $description = null,
        private ?string $label = ''
    )
    {
    }

    public function color(): ?string
    {
        return $this->color;
    }

    public function hex(): ?string
    {
        return $this->hex;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function label(): ?string
    {
        return $this->label;
    }
}

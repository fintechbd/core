<?php

namespace Fintech\Core\Attributes;

use Attribute;
use Fintech\Core\Enums\Color;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Enumeration
{
    /**
     * @param Color $color
     * @param string|null $description
     * @param string|null $label
     */
    public function __construct(
        public Color $color = Color::Black,
        public ?string $description = null,
        public ?string $label = null
    ) {
    }
}

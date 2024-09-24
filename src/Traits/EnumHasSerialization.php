<?php

namespace Fintech\Core\Traits;

use Fintech\Core\Enums\Color;

trait EnumHasSerialization
{
    /**
     * Return enum entries as a json encoded string
     *
     * @return string
     */
    public static function toJson(): string
    {
        return json_encode(self::cases());
    }

    /**
     * Return enum all entries as a key value pair list
     *
     * @return array<string, mixed>
     */
    public static function toArray(): array
    {
        return array_combine(self::values(), self::names());
    }

    /**
     * Return enum all items values as list or array
     *
     * @return array<mixed>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Return a enum cases as array
     *
     * @return array<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Return enum all entries as a key value pair list
     *
     * @return array<int,array>
     */
    public static function toList(): array
    {
        return array_map(fn ($case) => $case->jsonSerialize(), self::cases());
    }

    /**
     * Return one of the case that name match
     *
     * @param string $name
     * @return self
     */
    public static function name(string $name): self
    {
        $name = strtolower($name);
        foreach (self::cases() as $case) {
            if (strtolower($case->name) === $name) {
                return $case;
            }
        }

        throw new \ValueError("{$name} is a invalid backing name for" . preg_replace('([A-Z])', " $0", class_basename(self::class)) . " enum.");
    }

    /**
     *  Return the name of the enum case as human form
     *
     * @param null $name
     * @return string
     */
    public function label($name = null): string
    {
        $name = $name ?: $this->name;

        return trim(preg_replace('([A-Z])', " $0", $name));
    }

    /**
     *  Verify that is an enum case or case value exists
     *
     * @param $element
     * @return bool
     */
    public static function exists($element): bool
    {
        if ($element instanceof self) {
            $element = $element->value;
        }

        foreach (self::cases() as $case) {
            if (strtolower($case->value) === strtolower($element)) {
                return true;
            }
        }

        return false;
    }

    /**
     *  Return the JSON Representation of enum
     *
     * @return bool
     */
    public function jsonSerialize(): mixed
    {
        $reflection = new \ReflectionEnumBackedCase($this, $this->name);
        $attributes = $reflection->getAttributes(\Fintech\Core\Attributes\Enumeration::class);
        $properties['value'] = $this->value;
        $properties['name'] = $this->name;
        $properties['label'] = $this->label();
        $properties['color'] = Color::Black->name;
        $properties['hex'] = Color::Black->value;
        $properties['description'] = '';
        $properties['flutter'] = str_replace('#', '0xFF', Color::Black->value);


        if (!empty($attributes[0])) {
            $attribute = $attributes[0]->newInstance();
            $properties['description'] = $attribute->description ?? '';
            $properties['color'] = $attribute->color->name;
            $properties['hex'] = $attribute->color->value.'FF';
            $properties['flutter'] = str_replace('#', '0xFF', $attribute->color->value);
        }

        return $properties;
    }
}

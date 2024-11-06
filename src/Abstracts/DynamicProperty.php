<?php

namespace Fintech\Core\Abstracts;

use ArrayAccess;
use Fintech\Core\Supports\Utility;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use InvalidArgumentException;
use JsonSerializable;

/**
 * @template TKey of array-key
 * @template TValue
 * @property bool $status true if operation is successful
 * @property string $message vendor status conclusion message
 * @property mixed $original vendor plain response
 *
 * @method self status(bool $status = false)
 * @method self message(string $message = '')
 * @method self original(mixed $response)
 */
abstract class DynamicProperty implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
    protected array $attributes = [];

    protected array $fillable = [];

    protected array $casts = [];

    protected array $defaults = [];

    public function __construct(array $attributes = [])
    {
        foreach ($this->defaults as $key => $value) {
            $this->attributes[$key] = $value;
        }

        foreach ($attributes as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Get a value of any attribute
     *
     * @param string $name
     * @return TValue Can return all value types.
     */
    public function __get(string $name): mixed
    {
        return $this->offsetGet($name);
    }

    /**
     * Set a value to any attribute
     *
     * @param string $name
     * @param TValue $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->offsetSet($name, $value);
    }

    /**
     * Whether an attribute exists
     *
     * @param string $name
     * @return bool true on success or false on failure.
     */
    public function __isset(string $name): bool
    {
        return $this->offsetExists($name);
    }

    /**
     * Delete a attributes
     *
     * @param string $name
     * @return void
     */
    public function __unset(string $name): void
    {
        $this->offsetUnset($name);
    }

    /**
     * When object is treated as string return
     * the object to its JSON representation
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    public function __call(string $name, array $arguments): self
    {
        $value = null;

        if (!empty($arguments)) {
            $value = array_shift($arguments);
        }

        if ($this->offsetExists($name)) {
            $this->offsetSet($name, $value);
            return $this;
        }

        throw new \BadMethodCallException("Call to undefined method " . __CLASS__ . "::{$name}()");

    }

    /**
     * Whether an offset exists in attributes
     *
     * @param mixed $offset
     * @return bool true on success or false on failure.
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->attributes);
    }

    /**
     * Get a value of any offset attribute
     *
     * @param TKey $offset
     * @return TValue Can return all value types.
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (!in_array($offset, $this->fillable, true)) {
            throw new InvalidArgumentException("The attribute '{$offset}' does not exist.");
        }

        if (isset($this->attributes[$offset])) {
            return $this->attributes[$offset];
        }

        return null;
    }

    /**
     * Set a value to any offset attribute
     *
     * @param TKey $offset
     * @param TValue $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!in_array($offset, $this->fillable, true)) {
            throw new InvalidArgumentException("The attribute '{$offset}' is not allowed to be fill.");
        }

        if (isset($this->casts[$offset])) {
            $value = Utility::typeCast($value, $this->casts[$offset]);
        }

        $this->attributes[$offset] = $value;
    }

    /**
     * Delete a offset from attributes
     *
     * @param TKey $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        if (isset($this->attributes[$offset])) {
            unset($this->attributes[$offset]);
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        $this->attributes['original'] = json_decode(json_encode($this->attributes['original']), true);

        $attributes = $this->attributes;

        unset($attributes['timeline']);

        ksort($attributes);

        return $attributes;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        $attributes = $this->toArray();

        return json_encode($attributes, $options);
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }
}

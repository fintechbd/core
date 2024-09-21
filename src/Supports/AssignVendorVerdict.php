<?php

namespace Fintech\Core\Supports;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use InvalidArgumentException;


/**
 * @template TKey of array-key
 * @template TValue
 * @property bool $status true if operation is successful
 * @property string $message vendor status conclusion message
 * @property string $ref_number vendor provided a unique reference number
 * @property mixed $original vendor plain response
 * @property float $amount the total amount the vendor deposited or deducted
 * @property float $charge if that amount includes additional charge
 * @property float $discount if that amount includes additional discount
 * @property float $commission if that amount includes additional commission
 * @property array $timeline order timeline entry
 *
 * @method self status(bool $status = false)
 * @method self message(string $message = '')
 * @method self ref_number(string $ref_number = '')
 * @method self original(mixed $response)
 * @method self amount(float|int $amount = 0)
 * @method self charge(float|int $charge = 0)
 * @method self discount(float|int $discount = 0)
 * @method self commission(float|int $commission = 0)
 * @method self timeline(array $messages =[])
 */
class AssignVendorVerdict implements ArrayAccess, Arrayable, Jsonable
{
    private array $attributes = [];

    private array $fillable = ['status', 'message', 'ref_number', 'original', 'amount', 'charge', 'discount', 'commission', 'timeline'];

    private array $casts = [
        'status' => 'bool',
        'message' => 'string',
        'ref_number' => 'string',
        'amount' => 'float',
        'charge' => 'float',
        'discount' => 'float',
        'commission' => 'float',
        'timeline' => 'array'
    ];

    private array $defaults = [
        'status' => false,
        'message' => '',
        'ref_number' => '',
        'original' => null,
        'amount' => 0,
        'charge' => 0,
        'discount' => 0,
        'commission' => 0,
        'timeline' => [
            'message' => '',
            'flag' => 'info',
            'timestamp' => null
        ]
    ];

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
        if ($this->offsetExists($name)) {
            $this->offsetSet($name, ($arguments[0] ?? $this->defaults[$name] ?? null));

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

        return $this->attributes;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->attributes, $options);
    }

    public function orderTimeline(string $message, string $flag = 'info'): static
    {
        $this->attributes['timeline']['message'] = $message;
        $this->attributes['timeline']['flag'] = $flag;
        $this->attributes['timeline']['timestamp'] = now();

        return $this;
    }

    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }
}

<?php

namespace Bavix\Geo;

abstract class Unit implements \JsonSerializable
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $value;

    /**
     * Unit constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Unit
     */
    public static function make(float $value): self
    {
        return new static($value);
    }

    /**
     * @param float|self $miles
     * @return static
     */
    public static function fromMiles($miles): self
    {
        if (\is_object($miles) && $miles instanceof self) {
            $miles = $miles->miles();
        }

        return new static($miles * static::oneMile());
    }

    /**
     * @param string|self $unit
     * @return static
     */
    public function to($unit)
    {
        /**
         * @var self $unit
         */
        return $unit::fromMiles($this->miles());
    }

    /**
     * @return float
     */
    public function miles(): float
    {
        return $this->value / static::oneMile();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'miles' => $this->miles()
        ];
    }

    /**
     * @return float
     */
    abstract public static function oneMile(): float;

}

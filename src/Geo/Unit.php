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
     * @param float $miles
     * @return static
     */
    public static function fromMiles(float $miles): self
    {
        return new static($miles * static::oneMile());
    }

    /**
     * @param string $unit
     * @return static
     */
    public function to(string $unit)
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

<?php

namespace Bavix\Geo;

use Bavix\Geo\Value\Axis;

class Coordinate implements \JsonSerializable
{

    /**
     * @var Axis
     */
    public $latitude;

    /**
     * @var Axis
     */
    public $longitude;

    /**
     * Coordinate constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = Axis::make();
        $this->latitude->degrees = $latitude;
        $this->latitude = $this->latitude->proxy(); // readOnly

        $this->longitude = Axis::make();
        $this->longitude->degrees = $longitude;
        $this->longitude = $this->longitude->proxy();
    }

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return Coordinate
     */
    public static function make(float $latitude, float $longitude): self
    {
        return new static($latitude, $longitude);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Coordinate
     */
    public function plus(float $latitude, float $longitude = null): self
    {
        $longitude = $longitude ?: $latitude;

        return static::make(
            $this->latitude->degrees + $latitude,
            $this->longitude->degrees + $longitude
        );
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return Coordinate
     */
    public function minus(float $latitude, float $longitude = null): self
    {
        $longitude = $longitude ?: $latitude;

        return static::make(
            $this->latitude->degrees - $latitude,
            $this->longitude->degrees - $longitude
        );
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }

}

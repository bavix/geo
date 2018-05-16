<?php

namespace Bavix\Geo;

use Bavix\Geo\Unit\Distance;
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
     * @see https://en.wikipedia.org/wiki/Great-circle_distance
     *
     * @param self $object
     *
     * @return Distance
     */
    public function distanceTo(self $object): Distance
    {
        $theta = $this->longitude->radian - $object->longitude->radian;
        $partSin = \sin($this->latitude->radian) * \sin($object->latitude->radian);
        $partCos = \cos($this->latitude->radian) * \cos($object->latitude->radian) * \cos($theta);
        $dist = \rad2deg(\acos($partSin + $partCos));

        return Distance::make([
            Distance::PROPERTY_NAUTICAL_MILES => $dist * 60.
        ]);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return static
     */
    public static function make(float $latitude, float $longitude): self
    {
        return new static($latitude, $longitude);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return static
     */
    public function plus(float $latitude, float $longitude): self
    {
        return static::make(
            $this->latitude->degrees + $latitude,
            $this->longitude->degrees + $longitude
        );
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return static
     */
    public function minus(float $latitude, float $longitude): self
    {
        return $this->plus(
            -$latitude,
            -$longitude
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

<?php

namespace Bavix\Geo;

use Bavix\Geo\Unit\Distance;
use Bavix\Geo\Value\Axis;

/**
 * Class Coordinate
 *
 * @package Bavix\Geo
 *
 * @property-read Axis $latitude
 * @property-read Axis $longitude
 */
class Coordinate implements \JsonSerializable
{

    /**
     * @var array
     */
    protected $getter = [
        'latitude' => true,
        'longitude' => true,
    ];

    /**
     * @var Axis
     */
    protected $latitude;

    /**
     * @var Axis
     */
    protected $longitude;

    /**
     * Coordinate constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = Axis::make();
        $this->latitude->degrees = $latitude;
        $this->longitude = Axis::make();
        $this->longitude->degrees = $longitude;
    }

    /**
     * @param string $name
     *
     * @return Axis
     */
    public function __get($name): Axis
    {
        if (!isset($this->getter[$name])) {
            throw new \InvalidArgumentException(__METHOD__);
        }

        return $this->$name->proxy();
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    public function __set($name, $value)
    {
        throw new \InvalidArgumentException(__METHOD__);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->getter[$name]);
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
        return Distance::fromNauticalMiles($dist * 60.);
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
     * @param float|Axis $latitude
     * @param float|Axis $longitude
     * @return static
     */
    public function plus($latitude, $longitude): self
    {
        $latitude = \is_object($latitude) ? $latitude->degrees : $latitude;
        $longitude = \is_object($longitude) ? $longitude->degrees : $longitude;

        return static::make(
            $this->latitude->degrees + $latitude,
            $this->longitude->degrees + $longitude
        );
    }

    /**
     * @param float|Axis $latitude
     * @param float|Axis $longitude
     * @return static
     */
    public function minus($latitude, $longitude): self
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

<?php

namespace Bavix\Geo;

class Coordinate implements \JsonSerializable
{

    /**
     * @var AxisValue
     */
    protected $latitude;

    /**
     * @var AxisValue
     */
    protected $longitude;

    /**
     * Coordinate constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = AxisValue::make();
        $this->latitude->degrees = $latitude;

        $this->longitude = AxisValue::make();
        $this->longitude->degrees = $longitude;
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
     * @return AxisValue
     */
    public function latitude(): AxisValue
    {
        return $this->latitude;
    }

    /**
     * @return AxisValue
     */
    public function longitude(): AxisValue
    {
        return $this->longitude;
    }

    /**
     * @return float
     * @deprecated use latitude
     */
    public function getLatitudeDeg(): float
    {
        return $this->latitude->degrees;
    }

    /**
     * @return float
     * @deprecated use longitude
     */
    public function getLongitudeDeg(): float
    {
        return $this->longitude->degrees;
    }

    /**
     * @return float
     * @deprecated use latitude
     */
    public function getLatitudeRad(): float
    {
        return $this->latitude->radian;
    }

    /**
     * @return float
     * @deprecated use longitude
     */
    public function getLongitudeRad(): float
    {
        return $this->longitude->radian;
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

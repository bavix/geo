<?php

namespace Bavix\Geo;

class Coordinate implements \JsonSerializable
{

    /**
     * @var float
     */
    protected $latitude;

    /**
     * @var float
     */
    protected $longitude;

    /**
     * Coordinate constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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
     * @return float
     */
    public function getLatitudeDeg(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitudeDeg(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitudeRad(): float
    {
        return \deg2rad($this->latitude);
    }

    /**
     * @return float
     */
    public function getLongitudeRad(): float
    {
        return \deg2rad($this->longitude);
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

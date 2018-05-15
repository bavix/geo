<?php

namespace Bavix\Geo;

/**
 * Class Figure
 * @package Bavix\Geo
 */
abstract class Figure implements \JsonSerializable
{

    /**
     * @param Coordinate $point
     * @return bool
     */
    public function contain(Coordinate $point): bool
    {
        return $this->toPolygon()->contains($point);
    }

    /**
     * @return Polygon
     */
    abstract public function toPolygon(): Polygon;

}

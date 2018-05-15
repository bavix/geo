<?php

namespace Bavix\Geo;

interface GeometryInterface extends \Countable
{
    /**
     * @return Coordinate[]
     */
    public function points(): array;
}

<?php

namespace Bavix\Geo\Geometry;

use Bavix\Geo\Coordinate;

class Quadrangle extends Geometrable
{

    /**
     * @var int
     */
    protected $numberPoints = 4;

    /**
     * @param Coordinate $center
     * @param float      $dx
     * @param float      $dy
     *
     * @return static
     */
    public static function makeWithXY(Coordinate $center, float $dx, float $dy): self
    {
        $self = new static();
        $self->push((clone $center)->plus(-$dx, $dy));
        $self->push((clone $center)->plus($dx, $dy));
        $self->push((clone $center)->plus($dx, -$dy));
        $self->push((clone $center)->plus(-$dx, -$dy));
        return $self;
    }

}

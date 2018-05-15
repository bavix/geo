<?php

namespace Bavix\Geo;

class Polygon implements GeometryInterface
{

    /**
     * @var Coordinate[]
     */
    protected $points = [];

    /**
     * @param Coordinate $point
     * @return static
     */
    public function push(Coordinate $point): self
    {
        $this->points[] = $point;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function count(): int
    {
        return \count($this->points);
    }

    /**
     * @return Coordinate[]
     */
    public function points(): array
    {
        return $this->points;
    }

    /**
     * @return float[]
     */
    public function latitudes(): array
    {
        $data = [];
        foreach ($this->points as $point) {
            $data[] = $point->latitude()->degrees;
        }
        return $data;
    }

    /**
     * @return float[]
     */
    public function longitudes(): array
    {
        $data = [];
        foreach ($this->points as $point) {
            $data[] = $point->longitude()->degrees;
        }
        return $data;
    }

    /**
     * @see https://wrf.ecse.rpi.edu//Research/Short_Notes/pnpoly.html
     *
     * @param Coordinate $point
     * @return bool
     */
    public function contains(Coordinate $point): bool
    {
        $result = false;
        $count = \count($this);
        $latitudes = $this->latitudes();
        $longitudes = $this->longitudes();
        for ($curr = 0, $prev = $count - 1; $curr < $count; $prev = $curr++) {
            if (($longitudes[$curr] > $point->longitude()->degrees) ^ ($longitudes[$prev] > $point->longitude()->degrees) &&
                $point->latitude()->degrees < ($latitudes[$prev] - $latitudes[$curr])
                * ($point->longitude()->degrees - $longitudes[$curr])
                / ($longitudes[$prev] - $longitudes[$curr])
                + $latitudes[$curr]) {
                $result = !$result;
            }
        }

        return $result;
    }

    /**
     * @return static
     */
    public function reverse(): self
    {
        $self = clone $this;
        $self->points = \array_reverse($this->points);
        return $self;
    }

}

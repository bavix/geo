<?php

namespace Bavix\Geo;

class Polygon implements \Countable
{

    /**
     * @var Coordinate[]
     */
    protected $points = [];

    /**
     * @param Coordinate $point
     * @return static
     */
    public function addPoint(Coordinate $point): self
    {
        $this->points[] = $point;
        return $this;
    }

    /**
     * @return Coordinate[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * @return float[]
     */
    public function getLatitudes(): array
    {
        $data = [];
        foreach ($this->points as $point) {
            $data[] = $point->getLatitudeDeg();
        }
        return $data;
    }

    /**
     * @return float[]
     */
    public function getLongitudes(): array
    {
        $data = [];
        foreach ($this->points as $point) {
            $data[] = $point->getLongitudeDeg();
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function count(): int
    {
        return \count($this->points);
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
        $latitudes = $this->getLatitudes();
        $longitudes = $this->getLongitudes();
        for ($curr = 0, $prev = $count - 1; $curr < $count; $prev = $curr++) {
            if (($longitudes[$curr] > $point->getLongitudeDeg()) ^ ($longitudes[$prev] > $point->getLongitudeDeg()) &&
                $point->getLatitudeDeg() < ($latitudes[$prev] - $latitudes[$curr])
                * ($point->getLongitudeDeg() - $longitudes[$curr])
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
    public function getReverse(): self
    {
        $self = clone $this;
        $self->points = \array_reverse($this->points);
        return $self;
    }

}

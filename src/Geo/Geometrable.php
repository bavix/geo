<?php

namespace Bavix\Geo;

abstract class Geometrable implements \Countable
{

    protected $numberPoints;

    /**
     * @var array
     */
    protected $points = [];

    /**
     * @param Coordinate $point
     * @return static
     */
    public function push(Coordinate $point): self
    {
        if ($this->numberPoints && $this->count() >= $this->numberPoints) {
            throw new \InvalidArgumentException('This geometric shape can\'t have ' . ($this->numberPoints + 1) .
                ' and more points');
        }

        $this->points[] = $point;
        return $this;
    }

    /**
     * @return Coordinate[]
     */
    public function points(): array
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->points);
    }

    /**
     * @return float[]
     */
    public function latitudes(): array
    {
        $data = [];
        foreach ($this->points as $point) {
            $data[] = $point->latitude->degrees;
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
            $data[] = $point->longitude->degrees;
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
        $count = \count($this);

        if ($this->numberPoints && $count !== $this->numberPoints) {
            throw new \InvalidArgumentException('It\'s not a geometric shape');
        }

        $result = false;
        $latitudes = $this->latitudes();
        $longitudes = $this->longitudes();

        for ($curr = 0, $prev = $count - 1; $curr < $count; $prev = $curr++) {
            if (($longitudes[$curr] > $point->longitude->degrees) ^ ($longitudes[$prev] > $point->longitude->degrees) &&
                $point->latitude->degrees < ($latitudes[$prev] - $latitudes[$curr])
                * ($point->longitude->degrees - $longitudes[$curr])
                / ($longitudes[$prev] - $longitudes[$curr])
                + $latitudes[$curr]) {
                $result = !$result;
            }
        }

        return $result;
    }

    /**
     * @param self $geometry
     * @return bool
     */
    public function containsGeometry(Geometrable $geometry): bool
    {
        foreach ($geometry->points() as $point) {
            if (!$this->contains($point)) {
                return false;
            }
        }

        return true;
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

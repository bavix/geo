<?php

namespace Bavix\Geo;

use Bavix\Geo\Geometry\Line;
use Bavix\Geo\Geometry\Quadrangle;
use Bavix\Geo\Unit\Item;

class Metrical
{

    /**
     * @param Coordinate $center
     * @param Item       $unit
     *
     * @return Quadrangle
     */
    public function squareByHypotenuse(Coordinate $center, Item $unit): Quadrangle
    {
        $item = clone $unit;
        $item->miles /= \sqrt(2);
        return $this->square($center, $item);
    }

    /**
     * @param Coordinate $center
     * @param Item $unit
     * @return Quadrangle
     */
    public function square(Coordinate $center, Item $unit): Quadrangle
    {
        return $this->rectangle($center, $unit, $unit);
    }

    /**
     * @param Coordinate $center
     * @param Item $unitX
     * @param Item $unitY
     * @return Quadrangle
     */
    public function rectangle(Coordinate $center, Item $unitX, Item $unitY): Quadrangle
    {
        $vx = $this->speed($unitX);
        $vy = $this->speed($unitY);
        $dx = \deg2rad(\hypot($vx, $vx) / 2.);
        $dy = \deg2rad(\hypot(0, $vy));

        $computedX = $center->plus($dx, 0);
        $computedY = $center->plus(0, $dy);

        $lineX = new Line();
        $lineX->push($center);
        $lineY = clone $lineX;
        $lineX->push($computedX);
        $lineY->push($computedY);

        $latitude = $this->axisComputed($lineX, $unitX);
        $longitude = $this->axisComputed($lineY, $unitY, false);

        return Quadrangle::makeWithXY(
            $center,
            $unitX->miles * $latitude,
            $unitY->miles * $longitude
        );
    }

    /**
     * @param Line $line
     * @param Item $unit
     * @param bool $isAxisX
     *
     * @return float
     */
    protected function axisComputed(Line $line, Item $unit, bool $isAxisX = true): float
    {
        $computed = $line->pop();
        $center = $line->pop();

        $iterator = 0;
        $eps = $this->computedEps($unit);
        $computed = $computed->plus(
            $eps * $isAxisX,
            $eps * !$isAxisX
        );

        while ($iterator < 256) {

            $distance = $center->distanceTo($computed);
            $eps += $this->computedEps($distance);

            if ($distance->compareTo($unit)->greaterThanOrEqual()) {
                break;
            }

            $computed = $computed->plus(
                $eps * $isAxisX,
                $eps * !$isAxisX
            );

            $iterator++;

        }

        if ($isAxisX) {
            $result = $center->latitude->degrees - $computed->latitude->degrees;
        } else {
            $result = $center->longitude->degrees - $computed->longitude->degrees;
        }

        return \abs($result) / $unit->miles;
    }

    /**
     * @param Item $axis
     *
     * @return float
     */
    protected function computedEps(Item $axis): float
    {
        return \max(
            \round($axis->miles, 5) / 1e5,
            1e-7
        );
    }

    /**
     * @param Item $unit
     *
     * @return float
     */
    protected function speed(Item $unit): float
    {
        return \rad2deg($unit->nauticalMiles / 60.);
    }

}

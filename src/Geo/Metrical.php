<?php

namespace Bavix\Geo;

use Bavix\Geo\Figures\SquareFigure;

class Metrical
{

    /**
     * @var string|Unit
     */
    protected $unit;

    /**
     * Distance constructor.
     * @param string $unit
     */
    public function __construct(string $unit = Units\MileUnit::class)
    {
        $this->unit = $unit;
    }

    /**
     * @param Coordinate $first
     * @param Coordinate $second
     *
     * @return Unit
     *
     * @see https://en.wikipedia.org/wiki/Great-circle_distance
     */
    public function distance(Coordinate $first, Coordinate $second): Unit
    {
        $theta = $first->getLongitudeDeg() - $second->getLongitudeDeg();
        $partSin = \sin($first->getLatitudeRad()) * \sin($second->getLatitudeRad());
        $partCos = \cos($first->getLatitudeRad()) * \cos($second->getLatitudeRad()) * \cos(\deg2rad($theta));
        $dist = \rad2deg(\acos($partSin + $partCos));
        $miles = $dist * 60 * 1.1515;

        return $this->unit::fromMiles($miles);
    }

    /**
     * @param Coordinate $center
     * @param Unit $unit
     * @return SquareFigure
     */
    public function squad(Coordinate $center, Unit $unit): SquareFigure
    {
        $distance = $unit->miles() / 60 / 1.1515;

        $dd = \rad2deg($distance);
        $dy = \deg2rad(hypot(0, $dd * 2) / 2.);
        $dx = \deg2rad(hypot($dd, $dd) / 2.);

        return (new SquareFigure())

            ->setLeftUp(new Coordinate(
                $center->getLatitudeDeg() - $dx,
                $center->getLongitudeDeg() - $dy
            ))

            ->setLeftDown(new Coordinate(
                $center->getLatitudeDeg() - $dx,
                $center->getLongitudeDeg() + $dy
            ))

            ->setRightUp(new Coordinate(
                $center->getLatitudeDeg() + $dx,
                $center->getLongitudeDeg() - $dy
            ))

            ->setRightDown(new Coordinate(
                $center->getLatitudeDeg() + $dx,
                $center->getLongitudeDeg() + $dy
            ));
    }

}

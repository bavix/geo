<?php

namespace Bavix\Geo;

use Bavix\Geo\Figures\RectangleFigure;
use Bavix\Geo\Units\KilometerUnit;
use Bavix\Geo\Units\NauticalMileUnit;

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
        $theta = \deg2rad($first->getLongitudeDeg() - $second->getLongitudeDeg());
        $partSin = \sin($first->getLatitudeRad()) * \sin($second->getLatitudeRad());
        $partCos = \cos($first->getLatitudeRad()) * \cos($second->getLatitudeRad()) * \cos($theta);
        $dist = \rad2deg(\acos($partSin + $partCos));
        $miles = NauticalMileUnit::make($dist * 60.);
        return $miles->to($this->unit);
    }

    /**
     * @param Coordinate $center
     * @param Unit       $unit
     *
     * @return RectangleFigure
     */
    public function squareByHypotenuse(Coordinate $center, Unit $unit): RectangleFigure
    {
        return $this->square(
            $center,
            MathUnit::div($unit, \sqrt(2))
        );
    }

    /**
     * @param Coordinate $center
     * @param Unit $unit
     * @return RectangleFigure
     */
    public function square(Coordinate $center, Unit $unit): RectangleFigure
    {
        return $this->rectangle($center, $unit, $unit);
    }

    /**
     * @param Coordinate $center
     * @param Unit       $axis
     * @param bool       $isAxisX
     *
     * @return float
     */
    protected function axisComputed(Coordinate $center, Unit $axis, bool $isAxisX): float
    {
        $eps = $this->computedEps($axis);
        $computed = $center;

        do {
            $computed = $computed::make(
                $computed->getLatitudeDeg() + $eps * $isAxisX,
                $computed->getLongitudeDeg() + $eps * !$isAxisX
            );

            $distance = $this->distance($center, $computed);
            $eps += $this->computedEps($distance);

        } while (CompareUnit::less($distance, $axis));

        $result =
            ($center->getLatitudeDeg() - $computed->getLatitudeDeg()) * $isAxisX +
            ($center->getLongitudeDeg() - $computed->getLongitudeDeg()) * !$isAxisX;

        return \max($result, -$result) / $axis->miles();
    }

    /**
     * @param Unit $axis
     *
     * @return float
     */
    protected function computedEps(Unit $axis): float
    {
        return \max(
            \round($axis->miles(), 5) / 1e5,
            1e-7
        );
    }

    /**
     * @param Coordinate $center
     * @param Unit $axisX
     * @param Unit $axisY
     * @return RectangleFigure
     */
    public function rectangle(Coordinate $center, Unit $axisX, Unit $axisY): RectangleFigure
    {
        $latitude = $this->axisComputed($center, $axisX, true);
        $longitude = $this->axisComputed($center, $axisY, false);

        return RectangleFigure::make(
            $center,
            $latitude * $axisX->miles(),
            $longitude * $axisY->miles()
        );
    }

}

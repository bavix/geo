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
     * @param Coordinate $computed
     * @param Axis $axis
     *
     * @return float
     */
    protected function axisComputed(Coordinate $center, Coordinate $computed, Axis $axis): float
    {
        $eps = $this->computedEps($axis->unit());
        $computed = $computed->plus($eps);
        $iterator = 0;

        while ($iterator < 256) {

            $distance = $this->distance($center, $computed);
            $eps += $this->computedEps($distance);

            if (!CompareUnit::less($distance, $axis->unit())) {
                break;
            }

            $computed = $computed::make(
                $computed->getLatitudeDeg() + $eps * $axis->isAxisX(),
                $computed->getLongitudeDeg() + $eps * !$axis->isAxisX()
            );

            $iterator++;

        }

        if ($axis->isAxisX()) {
            $result = $center->getLatitudeDeg() - $computed->getLatitudeDeg();
        } else {
            $result = $center->getLongitudeDeg() - $computed->getLongitudeDeg();
        }

        return \abs($result) / $axis->unit()->miles();
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
     * @param Unit $unitX
     * @param Unit $unitY
     * @return RectangleFigure
     */
    public function rectangle(Coordinate $center, Unit $unitX, Unit $unitY): RectangleFigure
    {
        $axisX = Axis::make($unitX);
        $axisY = Axis::make($unitY, false);

        $vx = $this->speed($axisX->unit(NauticalMileUnit::class));
        $vy = $this->speed($axisY->unit(NauticalMileUnit::class));
        $dx = \deg2rad(\hypot($vx, $vx) / 2.);
        $dy = \deg2rad(\hypot(0, $vy));

        $computedX = new Coordinate(
            $center->getLatitudeDeg() + $dx,
            $center->getLongitudeDeg()
        );

        $computedY = new Coordinate(
            $center->getLatitudeDeg(),
            $center->getLongitudeDeg() + $dy
        );

        $latitude = $this->axisComputed($center, $computedX, $axisX);
        $longitude = $this->axisComputed($center, $computedY, $axisY);

        return RectangleFigure::make(
            $center,
            MathUnit::mul($axisX->unit(), $latitude)->miles(),
            MathUnit::mul($axisY->unit(), $longitude)->miles()
        );
    }

    /**
     * @param Unit $unit
     *
     * @return float
     */
    protected function speed(Unit $unit): float
    {
        return \rad2deg(NauticalMileUnit::fromMiles($unit)->value() / 60.);
    }

}

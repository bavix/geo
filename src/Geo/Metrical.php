<?php

namespace Bavix\Geo;

use Bavix\Geo\Figures\RectangleFigure;
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
     * @param Coordinate $from
     * @param Coordinate $to
     *
     * @return Unit
     *
     * @see https://en.wikipedia.org/wiki/Great-circle_distance
     */
    public function distance(Coordinate $from, Coordinate $to): Unit
    {
        $theta = $from->longitude()->radian - $to->longitude()->radian;
        $partSin = \sin($from->latitude()->radian) * \sin($to->latitude()->radian);
        $partCos = \cos($from->latitude()->radian) * \cos($to->latitude()->radian) * \cos($theta);
        $dist = \rad2deg(\acos($partSin + $partCos));
        return NauticalMileUnit::make($dist * 60.)
            ->to($this->unit);
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
            $center->latitude()->degrees + $dx,
            $center->longitude()->degrees
        );

        $computedY = new Coordinate(
            $center->latitude()->degrees,
            $center->longitude()->degrees + $dy
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
                $computed->latitude()->degrees + $eps * $axis->isAxisX(),
                $computed->longitude()->degrees + $eps * !$axis->isAxisX()
            );

            $iterator++;

        }

        if ($axis->isAxisX()) {
            $result = $center->latitude()->degrees - $computed->latitude()->degrees;
        } else {
            $result = $center->longitude()->degrees - $computed->longitude()->degrees;
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
     * @param Unit $unit
     *
     * @return float
     */
    protected function speed(Unit $unit): float
    {
        return \rad2deg(NauticalMileUnit::fromMiles($unit)->value() / 60.);
    }

}

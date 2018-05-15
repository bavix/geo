<?php

namespace Bavix\Geo\Figures;

use Bavix\Geo\Coordinate;
use Bavix\Geo\Figure;
use Bavix\Geo\Polygon;

/**
 * Class RectangleFigure
 *
 * @package Bavix\Geo\Figures
 *
 * @deprecated
 */
class RectangleFigure extends Figure
{

    /**
     * @var Coordinate
     */
    protected $leftUp;

    /**
     * @var Coordinate
     */
    protected $rightUp;

    /**
     * @var Coordinate
     */
    protected $leftDown;

    /**
     * @var Coordinate
     */
    protected $rightDown;

    /**
     * RectangleFigure constructor.
     * @param Coordinate|null $leftUp
     * @param Coordinate|null $rightDown
     */
    public function __construct(Coordinate $leftUp = null, Coordinate $rightDown = null)
    {
        $this->leftUp = $leftUp;
        $this->rightDown = $rightDown;
        $this->calculate();
    }

    /**
     * @return void
     */
    protected function calculate()
    {
        if (!$this->leftUp || !$this->rightDown) {
            return;
        }

        $this->setLeftDown(Coordinate::make(
            $this->leftUp->latitude()->degrees,
            $this->rightDown->longitude()->degrees
        ));

        $this->setRightUp(Coordinate::make(
            $this->rightDown->latitude()->degrees,
            $this->leftUp->longitude()->degrees
        ));
    }

    /**
     * @param Coordinate $center
     * @param float $dx
     * @param float $dy
     *
     * @return self
     */
    public static function make(Coordinate $center, float $dx, float $dy): self
    {
        return new static(
            (clone $center)->minus($dx, $dy),
            (clone $center)->plus($dx, $dy)
        );
    }

    /**
     * @return Coordinate
     */
    public function getLeftUp(): Coordinate
    {
        return $this->leftUp;
    }

    /**
     * @param Coordinate $leftUp
     * @return self
     */
    public function setLeftUp(Coordinate $leftUp): self
    {
        $this->leftUp = $leftUp;
        return $this;
    }

    /**
     * @return Coordinate
     */
    public function getRightUp(): Coordinate
    {
        return $this->rightUp;
    }

    /**
     * @param Coordinate $rightUp
     * @return self
     */
    public function setRightUp(Coordinate $rightUp): self
    {
        $this->rightUp = $rightUp;
        return $this;
    }

    /**
     * @return Coordinate
     */
    public function getLeftDown(): Coordinate
    {
        return $this->leftDown;
    }

    /**
     * @param Coordinate $leftDown
     * @return self
     */
    public function setLeftDown(Coordinate $leftDown): self
    {
        $this->leftDown = $leftDown;
        return $this;
    }

    /**
     * @return Coordinate
     */
    public function getRightDown(): Coordinate
    {
        return $this->rightDown;
    }

    /**
     * @param Coordinate $rightDown
     * @return self
     */
    public function setRightDown(Coordinate $rightDown): self
    {
        $this->rightDown = $rightDown;
        return $this;
    }

    /**
     * @return Polygon
     */
    public function toPolygon(): Polygon
    {
        return (new Polygon())
            ->push($this->getLeftUp())
            ->push($this->getRightUp())
            ->push($this->getRightDown())
            ->push($this->getLeftDown());
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'leftUp' => $this->leftUp,
            'leftDown' => $this->leftDown,
            'rightUp' => $this->rightUp,
            'rightDown' => $this->rightDown,
        ];
    }

}

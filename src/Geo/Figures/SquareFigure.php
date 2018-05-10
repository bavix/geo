<?php

namespace Bavix\Geo\Figures;

use Bavix\Geo\Coordinate;

class SquareFigure implements \JsonSerializable
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

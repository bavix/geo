<?php

namespace Bavix\Geo;

/**
 * Class Axis
 *
 * @package Bavix\Geo
 *
 * @deprecated
 */
class Axis
{

    /**
     * @var bool
     */
    protected $isAxisX;

    /**
     * @var Unit
     */
    protected $unit;

    /**
     * Axis constructor.
     * @param Unit $unit
     * @param bool $isAxisX
     */
    public function __construct(Unit $unit, bool $isAxisX = true)
    {
        $this->unit = $unit;
        $this->isAxisX = $isAxisX;
    }

    /**
     * @param Unit $unit
     * @param bool $isAxisX
     * @return Axis
     */
    public static function make(Unit $unit, bool $isAxisX = true): self
    {
        return new static($unit, $isAxisX);
    }

    /**
     * @return bool
     */
    public function isAxisX(): bool
    {
        return $this->isAxisX;
    }

    /**
     * @param string $to
     *
     * @return Unit
     */
    public function unit(string $to = null): Unit
    {
        if ($to) {
            return $this->unit->to($to);
        }

        return $this->unit;
    }

}

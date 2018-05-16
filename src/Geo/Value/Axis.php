<?php

namespace Bavix\Geo\Value;

/**
 * Class AxisProperty
 *
 * @package Bavix\Geo
 *
 * @property float $degrees
 * @property float $radian
 *
 * @method static Axis fromDegrees(float $value)
 * @method static Axis fromRadian(float $value)
 */
class Axis extends Valable
{

    const PROPERTY_DEGREES = 'degrees';
    const PROPERTY_RADIAN = 'radian';

    /**
     * @var array
     */
    protected $properties = [
        self::PROPERTY_DEGREES => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_RADIAN => 'deg2rad'
            ],
        ],
        self::PROPERTY_RADIAN => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_DEGREES => 'rad2deg'
            ],
        ],
    ];

    /**
     * @param float $value
     * @return float
     */
    protected function deg2rad(float $value): float
    {
        return \deg2rad($value);
    }

    /**
     * @param float $value
     * @return float
     */
    protected function rad2deg(float $value): float
    {
        return \rad2deg($value);
    }

}

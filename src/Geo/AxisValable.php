<?php

namespace Bavix\Geo;

/**
 * Class AxisProperty
 *
 * @package Bavix\Geo
 *
 * @property float $degrees
 * @property float $radian
 */
class AxisValable extends Valable
{
    const PROPERTY_DEGREES = 'degrees';
    const PROPERTY_RADIAN = 'radian';

    /**
     * @var array
     */
    protected $properties = [
        self::PROPERTY_DEGREES => [
            'type' => self::WRITE,
            'depends' => [
                self::PROPERTY_RADIAN => 'deg2rad'
            ],
        ],
        self::PROPERTY_RADIAN => [
            'type' => self::WRITE,
            'depends' => [
                self::PROPERTY_DEGREES => 'rad2deg'
            ],
        ],
    ];
}

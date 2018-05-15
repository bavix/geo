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
class AxisProperty extends Property
{
    /**
     * @var array
     */
    protected $properties = [
        'degrees' => [
            'type' => self::WRITE,
            'update' => [
                'radian' => 'deg2rad'
            ],
        ],
        'radian' => [
            'type' => self::WRITE,
            'update' => [
                'degrees' => 'rad2deg'
            ],
        ],
    ];
}

<?php

namespace Bavix\Geo\Unit;

use Bavix\Geo\Comparable;
use Bavix\Geo\Valable;

/**
 * Class Unit
 *
 * @package Bavix\Geo
 *
 * @property float $yards
 * @property float $meters
 * @property float $kilometers
 * @property float miles
 * @property float $nauticalMiles
 * @property float $wheels
 */
class Unit extends Valable implements Comparable
{

    const PROPERTY_YARDS = 'yards';
    const PROPERTY_METERS = 'meters';
    const PROPERTY_KILOMETERS = 'kilometers';
    const PROPERTY_MILES = 'miles';
    const PROPERTY_NAUTICAL_MILES = 'nauticalMiles';
    const PROPERTY_WHEELS = 'wheels';

    /**
     * @var array
     */
    protected $properties = [
        self::PROPERTY_YARDS => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_MILES => Provider\Yard::class,
            ],
        ],
        self::PROPERTY_METERS => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_MILES => Provider\Meter::class,
            ],
        ],
        self::PROPERTY_KILOMETERS => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_MILES => Provider\Kilometer::class,
            ],
        ],
        self::PROPERTY_MILES => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_YARDS => Provider\Yard::class,
                self::PROPERTY_METERS => Provider\Meter::class,
                self::PROPERTY_KILOMETERS => Provider\Kilometer::class,
                self::PROPERTY_NAUTICAL_MILES => Provider\NauticalMile::class,
                self::PROPERTY_WHEELS => Provider\Wheel::class,
            ],
        ],
        self::PROPERTY_NAUTICAL_MILES => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_MILES => Provider\NauticalMile::class,
            ],
        ],
        self::PROPERTY_WHEELS => [
            'type' => self::WRITE,
            'modify' => [
                self::PROPERTY_MILES => Provider\Wheel::class,
            ],
        ],
    ];

    /**
     * @param Unit $object
     * @return int
     */
    public function compareTo($object): int
    {
        return $this->miles <=> $object->miles;
    }

}

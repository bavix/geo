<?php

namespace Bavix\Geo;

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
     * @param self $object
     * @return int
     */
    public function compareTo(self $object): int
    {
        return $this->miles <=> $object->miles;
    }

}

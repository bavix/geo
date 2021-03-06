<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Distance;

class Meter extends Kilometer
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Distance::PROPERTY_METERS;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'meter';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return parent::oneMile() * 1000;
    }

}

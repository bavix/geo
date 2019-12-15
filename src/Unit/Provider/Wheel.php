<?php

/**
 * Dark Tower
 */

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Distance;
use Bavix\Geo\Unit\Distable;

class Wheel extends Distable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Distance::PROPERTY_WHEELS;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'wheel';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 0.59171597633;
    }

}

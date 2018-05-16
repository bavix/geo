<?php

/**
 * Dark Tower
 */

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Unit;
use Bavix\Geo\Unit\Unitable;

class Wheel extends Unitable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Unit::PROPERTY_WHEELS;
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

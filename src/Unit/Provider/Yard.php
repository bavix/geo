<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Distance;
use Bavix\Geo\Unit\Distable;

class Yard extends Distable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Distance::PROPERTY_YARDS;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'yard';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 1760;
    }

}

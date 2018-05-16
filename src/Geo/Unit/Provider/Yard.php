<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Unit;
use Bavix\Geo\Unit\Unitable;

class Yard extends Unitable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Unit::PROPERTY_YARDS;
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

<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Item;
use Bavix\Geo\Unit\Unitable;

class NauticalMile extends Unitable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Item::PROPERTY_NAUTICAL_MILES;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'nautical mile';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 0.8689762419006481;
    }

}

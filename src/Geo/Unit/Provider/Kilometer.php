<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Item;
use Bavix\Geo\Unit\Unitable;

class Kilometer extends Unitable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Item::PROPERTY_KILOMETERS;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'kilometer';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 1.609344;
    }

}

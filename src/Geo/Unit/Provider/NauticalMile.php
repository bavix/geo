<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\UnitInterface;

class NauticalMile implements UnitInterface
{

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

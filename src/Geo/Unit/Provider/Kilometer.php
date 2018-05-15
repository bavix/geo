<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\UnitInterface;

class Kilometer implements UnitInterface
{

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

<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\UnitInterface;

class Yard implements UnitInterface
{

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
        return 0.000568182;
    }

}

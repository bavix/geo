<?php

/**
 * Dark Tower
 */

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\UnitInterface;

class Wheel implements UnitInterface
{

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

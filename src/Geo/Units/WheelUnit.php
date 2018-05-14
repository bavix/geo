<?php

/**
 * Dark Tower
 */

namespace Bavix\Geo\Units;

use Bavix\Geo\Unit;

class WheelUnit extends Unit
{

    /**
     * @var string
     */
    protected $name = 'wheel';

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 0.59171597633;
    }

}

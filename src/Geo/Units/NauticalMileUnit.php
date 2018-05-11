<?php

namespace Bavix\Geo\Units;

use Bavix\Geo\Unit;

class NauticalMileUnit extends Unit
{

    /**
     * @var string
     */
    protected $name = 'nautical mile';

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 1 / ((1852 / (3 * 0.3048)) / 1760);
    }

}

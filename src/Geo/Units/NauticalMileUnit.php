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
        return 0.868976;
    }

}

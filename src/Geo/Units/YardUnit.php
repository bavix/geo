<?php

namespace Bavix\Geo\Units;

use Bavix\Geo\Unit;

class YardUnit extends Unit
{

    /**
     * @var string
     */
    protected $name = 'yard';

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 0.000568182;
    }

}

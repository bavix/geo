<?php

namespace Bavix\Geo\Units;

use Bavix\Geo\Unit;

class MileUnit extends Unit
{

    /**
     * @var string
     */
    protected $name = 'mile';

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 1.;
    }

}

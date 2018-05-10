<?php

namespace Bavix\Geo\Units;

use Bavix\Geo\Unit;

class KilometerUnit extends Unit
{

    /**
     * @var string
     */
    protected $name = 'kilometer';

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 1.609344;
    }

}

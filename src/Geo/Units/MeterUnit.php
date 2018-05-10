<?php

namespace Bavix\Geo\Units;

class MeterUnit extends KilometerUnit
{

    /**
     * @var string
     */
    protected $name = 'meter';

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return parent::oneMile() * 1000;
    }

}

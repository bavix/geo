<?php

namespace Bavix\Geo\Unit\Provider;

class Meter extends Kilometer
{

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'meter';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return parent::oneMile() * 1000;
    }

}

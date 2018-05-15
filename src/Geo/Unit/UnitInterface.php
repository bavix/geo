<?php

namespace Bavix\Geo\Unit;

interface UnitInterface
{
    /**
     * @return string
     */
    public static function name(): string;

    /**
     * @return float
     */
    public static function oneMile(): float;
}

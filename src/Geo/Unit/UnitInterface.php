<?php

namespace Bavix\Geo\Unit;

use Bavix\Geo\Value\ValueInterface;

interface UnitInterface extends ValueInterface
{
    /**
     * @return string
     */
    public static function property(): string;

    /**
     * @return string
     */
    public static function name(): string;

    /**
     * @return float
     */
    public static function oneMile(): float;
}

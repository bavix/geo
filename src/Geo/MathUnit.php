<?php

namespace Bavix\Geo;

use Bavix\Geo\Units\Mile;

/**
 * Class MathUnit
 *
 * @package Bavix\Geo
 *
 * @deprecated
 */
class MathUnit
{

    /**
     * @param $value
     * @return float
     */
    protected static function miles($value): float
    {
        if (\is_object($value) && $value instanceof Unit)
        {
            return $value->miles();
        }

        return $value;
    }

    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     *
     * @return Mile
     */
    public static function add($unit, $value): Mile
    {
        return new Mile(static::miles($unit) + static::miles($value));
    }
    
    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     *
     * @return Mile
     */
    public static function sub($unit, $value): Mile
    {
        return new Mile(static::miles($unit) - static::miles($value));
    }
    
    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     *
     * @return Mile
     */
    public static function div($unit, $value): Mile
    {
        return new Mile(static::miles($unit) / static::miles($value));
    }
    
    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     *
     * @return Mile
     */
    public static function mul($unit, $value): Mile
    {
        return new Mile(static::miles($unit) * static::miles($value));
    }
    
}
